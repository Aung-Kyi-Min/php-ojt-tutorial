<?php

namespace App\Dao;

use App\Contracts\Dao\TaskDaoInterface;
use App\Models\Task;

class TaskDao implements TaskDaoInterface
{
    /**
     * Get task list
     * @return object
     */
    public function getTasks(): object
    {
        return Task::latest()->paginate(10);
    }

    /**
     * Save task
     * @param array
     * @return void
     */
    public function createTask(array $data): void
    {
        Task::create([
            'name' => $data['name']
        ]);
    }

    /**
     * Get task by id
     * @param int $id
     * @return object
     */
    public function getTaskById($id): object
    {
        return Task::findOrFail($id);
    }


    /**
     * Delete task by id
     * @param int $id
     * @return void
     */
    public function deleteTaskById($id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
