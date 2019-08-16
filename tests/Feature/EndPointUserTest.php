<?php

namespace Tests\Feature;

use App\Http\Requests\FormRequestUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EndPointUserTest extends TestCase
{
    /**
     * A basic feature testEndPointListUser.
     *
     * @return void
     */
    public function testEndPointListUser()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointShowUser.
     *
     * @return void
     */
    public function testEndPointShowUser()
    {
        $response = $this->get('/api/users/1');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointEditUser.
     *
     * @return void
     */
    public function testEndPointEditUser()
    {
        $response = $this->get('/api/users/1/edit');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointCreateUser.
     *
     * @return void
     */
    public function testEndPointCreateUser()
    {

        $user = [
            'name' => 'UserTest',
            'email' => 'usertest@test.com.br',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
        ];

        $response = $this->post('/api/users/', $user);
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointUpdateUser.
     *
     * @return void
     */
    public function testEndPointUpdateUser()
    {
        $user = User::all()->first();
        $id = $user->id;

        $user = [
            'name' => 'UserTest',
            'email' => 'usertest@test.com.br',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
        ];

        $response = $this->put('/api/users/'.$id.'/', $user);
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointDeleteUser.
     *
     * @return void
     */
    public function testEndPointDeleteUser()
    {
        $user = User::all()->first();
        $id = $user->id;

        $response = $this->delete('/api/users/'.$id.'');
        $response->assertStatus(200);
    }
}
