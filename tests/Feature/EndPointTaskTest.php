<?php

namespace Tests\Feature;

use App\Http\Requests\FormRequestUser;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EndPointTaskTest extends TestCase
{
    /**
     * A basic feature testEndPointListTask.
     *
     * @return void
     */
    public function testEndPointListTask()
    {
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointShowTask.
     *
     * @return void
     */
    public function testEndPointShowTask()
    {
        $response = $this->get('/api/tasks/1');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointEditTask.
     *
     * @return void
     */
    public function testEndPointEditTask()
    {
        $response = $this->get('/api/tasks/1/edit');
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointCreateTask.
     *
     * @return void
     */
    public function testEndPointCreateTask()
    {

        $user = [
            'description' => 'TaskTest',
            'status' => 0,
        ];

        $response = $this->post('/api/tasks/', $user);
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointUpdateTask.
     *
     * @return void
     */
    public function testEndPointUpdateTask()
    {
        $user = Task::all()->first();
        $id = $user->id;

        $user = [
            'description' => 'TaskTest',
            'status' => 0,
        ];

        $response = $this->put('/api/tasks/'.$id.'/', $user);
        $response->assertStatus(200);
    }

    /**
     * A basic feature testEndPointDeleteTask.
     *
     * @return void
     */
    public function testEndPointDeleteTask()
    {
        $user = Task::all()->first();
        $id = $user->id;

        $response = $this->delete('/api/tasks/'.$id.'');
        $response->assertStatus(200);
    }
}
