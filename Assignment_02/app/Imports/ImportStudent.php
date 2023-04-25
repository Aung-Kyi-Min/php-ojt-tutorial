<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStudent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name' => $row[0],
            'majors' => $row[1],
            'phone' => $row[2],
            'email' => $row[3],
            'address' => $row[4],
        ]);
    }
}
