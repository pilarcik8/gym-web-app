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
            $name = $request->post('name');
            $date = $request->post('date');
            $duration_minutes = (int)$request->post('duration_minutes');
            $trainer_id = (int)$request->post('trainer_id');
            $capacity = (int)$request->post('capacity');
            $description = $request->post('description');
            if ($description === '') {
                $description = null;
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
