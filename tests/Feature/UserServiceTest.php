<?php

namespace Tests\Feature;

use App\Exceptions\UserNotExistException;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private $userService;

    /**
     * UserServiceTest constructor.
     * @param $userService
     */

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    /**
     * @test
     */

    public function can_get_user_in_desc_order()
    {
        $userCollection = $this -> userService -> findAll();
        $users = $userCollection->all();

        $this->assertNotNull($users);
        $this->assertEquals(count($users), $users[0]->id);
        $this->assertGreaterThan($users[1]->id, $users[0]->id);
    }

    /**
     * @test
     */
    public function can_get_user_by_id() {
        try {
            $validId = 1;
            $user = $this -> userService->findById($validId);

            $this -> assertNotNull($user);
            $this -> assertEquals($validId, $user-> id);

            $invalidId = 2000;
            $user = $this -> userService->findById($invalidId);

        } catch (UserNotExistException $e) {
            $this -> assertInstanceOf(UserNotExistException::class, $e);
        }
    }
}
