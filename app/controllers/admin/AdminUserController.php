<?php
namespace App\Controllers\Admin;

use App\Models\User;

class AdminUserController extends AdminBaseController
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }


    public function index()
    {
        $users = $this->userModel->getAll();
        $this->render('users/index', ['users' => $users]);
    }
}