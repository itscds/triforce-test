<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_it_can_create_a_task()
    {
        $taskData = [
            'task_name' => 'Test Task',
            'is_completed' => false,
            'due_date' => now()->addDays(1)->toDateTimeString(),
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $this->assertDatabaseHas('tasks', $taskData);
        $response->assertRedirect(route('tasks.index'));

        // Log the task creation
        Log::info('Task created successfully.', ['task_data' => $taskData]);
    }




    public function test_it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $updatedData = [
            'task_name' => 'Updated Task',
            'is_completed' => true,
            'due_date' => now()->addDays(2)->toDateTimeString(),
        ];
        Log::info('Attempting to update task.', ['task_id' => $task->id, 'updated_data' => $updatedData]);

        $response = $this->put(route('tasks.update', $task->id), $updatedData);

        $this->assertDatabaseHas('tasks', $updatedData);
        $response->assertRedirect(route('tasks.index'));

        // Log the task update
        Log::info('Task updated successfully.', ['task_id' => $task->id, 'updated_data' => $updatedData]);
    }


     
    public function test_it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        Log::info('Attempting to delete task.', ['task_id' => $task->id]);

        $response = $this->delete(route('tasks.destroy', $task->id));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $response->assertRedirect(route('tasks.index'));

        // Log the task deletion
        Log::info('Task deleted successfully.', ['task_id' => $task->id]);
    }

    

    
}
