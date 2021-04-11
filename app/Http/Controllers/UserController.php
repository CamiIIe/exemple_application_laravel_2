<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller implements UserInterface
{
    private $userService;

    /**
     * UserController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function findAll()
    {
        $users = $this -> userService->findAll();
        return view('users.index', ['users' => $users]);
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function create(Request $request)
    {
        // TODO: Implement create() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


}
