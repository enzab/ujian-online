<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'nisn' => (int) $row['nisn'],
            'name' => $row['name'],
            'password' => $row['password'],
            'gender' => $row['gender'],
            'classrom_id' => (int) $row['classrom_id'],
        ]);
    }

    public function rule(): array
    {
        return [
            'nisn' => 'unique:students,nisn',
        ];
    }
}
