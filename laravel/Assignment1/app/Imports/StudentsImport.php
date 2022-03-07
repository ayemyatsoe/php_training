<?php

namespace App\Imports;

use App\Students;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Students([
            'name' => @$row['name'],
            'email' => @$row['email'],
            'dob' =>  $this->transformDate(@$row['dob']),
            'address' => @$row['address'],
            'major_id' => @$row['major_id'],
            'phone' => @$row['phone'],
        ]);
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}