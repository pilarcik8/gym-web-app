<?php

namespace App\Controllers;

use App\Models\Account;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class AdminController
 *
 * This controller manages admin-related actions within the application.It extends the base controller functionality
 * provided by BaseController.
 *
 * @package App\Controllers
 */
class AdminController extends BaseController
{
    /**
     * Authorizes actions in this controller.
     *
     * This method checks if the user is logged in, allowing or denying access to specific actions based
     * on the authentication state.
     *
     * @param string $action The name of the action to authorize.
     * @return bool Returns true if the user is logged in; false otherwise.
     */
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn();
    }

    /**
     * Displays the index page of the admin panel.
     *
     * This action requires authorization. It returns an HTML response for the admin dashboard or main page.
     *
     * @return Response Returns a response object containing the rendered HTML.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    /**
     * @throws \Exception
     */
    public function changeRole(Request $request): Response
    {
        $message = null;
        //if ($this->user->getRole() !== 'admin')
        if ($request->hasValue('changeRole')) {
            $id = (int)$request->post('id');
            $role = trim($request->post('role'));

            $account = Account::getOne($id);
            if ($account) {
                if ($account->getRole() === "admin") {
                    $adminCount = Account::getCount('`role` = ?', ["admin"]);
                    if ($adminCount <= 1 && $role !== "admin") {
                        $message = "Nie je možné zmeniť rolu posledného administrátora.";
                        return $this->redirect($this->url("admin.index"));
                    }
                }
                $account->setRole($role);
                $account->save();

                $message = "Role používateľa #$id bola zmenená na $role.";
            } else {
                $message = "Používateľ s ID #$id nebol nájdený.";
            }
        }
        return $this->redirect($this->url("admin.index"), compact("message"));
    }

    public function deleteUser(Request $request): Response
    {
        $message = null;

        if ($request->hasValue('deleteUser')) {
            $id = (int)$request->post('id');

            $account = Account::getOne($id);
            if (!$account) {
                $message = "Používateľ s ID #$id nebol nájdený.";
                return $this->redirect($this->url("admin.index"), compact("message"));
            }

            // Prevent deleting the currently logged-in user
            if (method_exists($this->user, 'getId') && (int)$this->user->getId() === $id) {
                $message = "Nemôžete vymazať svoj vlastný účet.";
                return $this->redirect($this->url("admin.index"), compact("message"));
            }

            // Prevent deleting the last admin
            $role = null;
            $role = $account->getRole();

            if ($role === 'admin') {
                $adminCount = Account::getCount('`role` = ?', ["admin"]);
                if ($adminCount <= 1) {
                    $message = "Nie je možné vymazať posledného administrátora.";
                    return $this->redirect($this->url("admin.index"), compact("message"));
                }
            }
            $account->delete();
        }
        return $this->redirect($this->url("admin.index"));
    }
}
