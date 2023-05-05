<?php

namespace App\Dao;

use App\Contracts\Dao\StudentDaoInterface;
use App\Models\Student;
use App\Exports\ExportStudent;
use Maatwebsite\Excel\Excel;

class StudentDao implements StudentDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getStudents(): object
    {
        return Student::paginate(3);
    }

    /**
     * Save user
     * @param array
     * @return void
     */
    public function createStudent(array $data): void
    {
        Student::create([
            'name' => $data['name'],
            'majors' => $data['majors'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getStudentById($id): object
    {
        return Student::findOrFail($id);
    }

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, $id): void
    {
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $data['name'],
            'majors' => $data['majors'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById($id): void
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }

}
