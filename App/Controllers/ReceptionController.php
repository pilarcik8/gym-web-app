<?php

namespace App\Controllers;

use App\Models\Account;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;


class ReceptionController extends BaseController
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

        if ($this->user->getRole() !== 'reception')
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

    public function addCredit(Request $request): Response
    {
        $message = null;
        if ($request->hasValue('addCredit')) {
            $amount = (float)$request->post('amount');
            $id = (int)$request->post('id');
            $acc = Account::getOne($id);
            if (!$acc) {
                $_SESSION['flash_message'] = "Účet s ID $id neexistuje.";
            }
            $acc->setCredit($acc->getCredit() + $amount);
            $acc->save();
        }
        return $this->redirect($this->url("reception.index"));
    }
}
