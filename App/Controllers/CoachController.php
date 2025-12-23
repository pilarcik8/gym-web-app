<?php

namespace App\Controllers;

use App\Models\Account;
use App\Models\Group_Class;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;


class CoachController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        if (!$this->user->isLoggedIn())
            return false;

        if ($this->user->getRole() !== 'trainer')
            return false;

        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);

        return $this->html(compact('message'));
    }

    /**
     * @throws \Exception
     */
    public function createGroupClass(Request $request): Response
    {
        if ($request->hasValue('createGroupClass')) {
            $name = trim((string) $request->post('name'));
            $date = $request->post('date');
            $duration_minutes = (int)$request->post('duration_minutes');
            $trainer_id = (int)$request->post('trainer_id');
            $capacity = (int)$request->post('capacity');
            $description = $request->post('description');

            if ($description !== null) {
                $description = trim((string) $description);
                if ($description === '') {
                    $description = null;
                }
            }

            $classStart = \DateTime::createFromFormat('Y-m-d\TH:i', $date);
            $minToStart = new \DateTime('now');
            $minToStart->modify('+24 hours');

            $classStartFmt = (clone $classStart)->format('Y-m-d H:i:s');
            $classEndFmt = ((clone $classStart)->modify('+'.$duration_minutes.' minutes'))->format('Y-m-d H:i:s');

            $trainer_conflicts = Group_Class::getAll(
                '`trainer_id` = ? AND `start_datetime` < ? AND DATE_ADD(`start_datetime`, INTERVAL `duration_minutes` MINUTE) > ?',
                [$trainer_id, $classEndFmt, $classStartFmt]
            );

            // kontrola ci v danom case uz nema naplanovanu hodinu/hodiny
            $conflictCount = count($trainer_conflicts);

            if ($conflictCount > 0) {
                $idsArray = [];

                foreach ($trainer_conflicts as $conflict) {
                    $idsArray[] = $conflict->getId();
                }

                if (count($idsArray) > 1) {
                    $last = array_pop($idsArray);
                    $ids = implode(', ', $idsArray) . ' a ' . $last;
                } else {
                    $ids = $idsArray[0];
                }
                if (count($idsArray) > 1) {
                    $_SESSION['flash_message'] =
                        "Tréner už má naplánované hodiny (ID: $ids) v tomto čase.";
                } else {
                    $_SESSION['flash_message'] =
                        "Tréner už má naplánovanú hodinu (ID: $ids) v tomto čase.";
                }
                return $this->redirect($this->url("coach.index"));
            }

            // kontrola ci je datum aspon 24 hod od aktualneho casu
            if ($classStart < $minToStart) {
                $_SESSION['flash_message'] = "Dátum musí byť aspoň: " . $classStart->format('d.m. Y H.i');
                return $this->redirect($this->url("coach.index"));
            }

            $gc_model = new Group_Class($name, $date, $duration_minutes, $trainer_id, $capacity, $description);
            $gc_model->save();
            $_SESSION['flash_message'] = "Hodina $name bola úspešne vytvorená.";
        }
        else {
            $_SESSION['flash_message'] = "Chyba pri vytváraní hodiny.";
        }

        return $this->redirect($this->url("coach.index"));
    }
}
