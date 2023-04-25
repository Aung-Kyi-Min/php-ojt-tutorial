<?php

namespace App\Services;

use App\Contracts\Dao\TaskDaoInterface;
use App\Contracts\Services\TaskServiceInterface;

/**
 * task Service class
 */
class TaskService implements TaskServiceInterface
{
    /**
     * task Dao
     */
    private $taskDao;

    /**
     * Class Constructor
     * @param taskDaoInterface
     * @return void
     */
    public function __construct(TaskDaoInterface $taskDao)
    {
        $this->taskDao = $taskDao;
    }

    /**
     * Get task list
     * @return object
     */
    public function getTasks(): object
    {
        return $this->taskDao->getTasks();
    }

    /**
     * Save task
     * @param array
     * @return void
     */
    public function createTask(array $data): void
    {
        // Mail Send Code
        $this->taskDao->createTask($data);
    }

    /**
     * Get task by id
     * @param int $id
     * @return object
     */
    public function getTaskById(int $id): object
    {
        return $this->taskDao->getTaskById($id);
    }

    /**
     * Update task
     * @param array $data
     * @param int $id
     * @return void
     */
    //public function updatetask(array $data, int $id): void
    //{
    //    $this->taskDao->updatetask($data, $id);
    //}

    /**
     * Delete task by id
     * @param int $id
     * @return void
     */
    public function deleteTaskById(int $id): void
    {
        $this->taskDao->deleteTaskById($id);
    }
}
