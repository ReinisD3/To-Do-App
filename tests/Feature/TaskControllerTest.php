<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use http\Env\Request;
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

        $this->assertDatabaseHas('tasks',['id'=>$task->id]);

    }
    public function test_controller_edit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id'=>$user->id]);
        $this->followingRedirects();

        $response = $this->get(route('tasks.edit',$task));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');



    }

    public function test_controller_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id'=>$user->id]);
        $this->post(route('tasks.store', $task));
//        $request = (new \Illuminate\Http\Client\Request(['name'=>'TEST']));

        $this->followingRedirects();

        $response = $this->put(route('tasks.update', $task));
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks' , [
            'id' => $task->id ]  );
//            'name'=> 'TEST']



    }

    public function test_controller_delete()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id'=> $user->id]);


        $this->post(route('tasks.store', $task));
        $this->followingRedirects();
        $response = $this->delete(route('tasks.destroy',$task));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks',['id'=>$task->id]);

    }
    public function test_controller_toggleComplete()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id'=> $user->id]);
        $this->followingRedirects();
        $response = $this->get(route('tasks.toggleComplete' , $task));

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks',[
            'id'=>$task->id,
            'completed_at' => now()
            ]);

    }
}
