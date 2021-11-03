<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_controller_show()
    {

        $this->actingAs(User::factory()->create());

        $response = $this->get('/tasks');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');

    }

    public function test_controller_create()
    {


        $this->actingAs(User::factory()->create());

        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');

    }

    public function test_controller_store()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id'=>$user->id]);
        $this->followingRedirects();
        $response = $this->post(route('tasks.store', $task));
        $response->assertStatus(200);
    }

    public function test_controller_edit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id'=>$user->id]);
        $this->followingRedirects();
        $response = $this->get(route('tasks.edit',$task));
        $response->assertStatus(200);


    }

    public function test_controller_delete()
    {
        $this->actingAs(User::factory()->create());
    }
}
