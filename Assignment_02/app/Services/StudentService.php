<?php

namespace App\Services;

use App\Contracts\Dao\StudentDaoInterface;
use App\Contracts\Services\StudentServiceInterface;
use Maatwebsite\Excel\Excel;
use App\Exports\ExportStudent;

/**
 * student Service class
 */
class StudentService implements StudentServiceInterface
{
    /**
     * student Dao
     */
    private $studentDao;

    /**
     * Class Constructor
     * @param studentDaoInterface
     * @return void
     */
    public function __construct(StudentDaoInterface $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    /**
     * Get student list
     * @return object
     */
    public function getStudents(): object
    {
        return $this->studentDao->getStudents();
    }

    /**
     * Save student
     * @param array
     * @return void
     */
    public function createStudent(array $data): void
    {
        // Mail Send Code
        $this->studentDao->createStudent($data);
    }

    /**
     * Get student by id
     * @param int $id
     * @return object
     */
    public function getStudentById(int $id): object
    {
        return $this->studentDao->getStudentById($id);
    }

    /**
     * Update student
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, int $id): void
    {
        $this->studentDao->updateStudent($data, $id);
    }

    /**
     * Delete student by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById(int $id): void
    {
        $this->studentDao->deleteStudentById($id);
    }
}
