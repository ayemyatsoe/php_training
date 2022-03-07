<?php

namespace App\Exports;

use App\Students;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection,WithHeadings
{

    public function headings(): array
    {
        return ["Name", "Email", "Date of Birth", "Address", "Phone","Major_ID"];
    }
    public function collection()
    {
        return Students::select('name','email','dob','address','phone','major_id')->get();

    }
}
