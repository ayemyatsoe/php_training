<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Majors;
class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $majors = [
            "Android",
            "PHP",
            "C#",
            "Laravel",
            "Javascript",
            "Ruby",
            "CSS"
        ];
        foreach ($majors as $major) {
            DB::table('majors')->insert([
                'name' => $major,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);

        }
    }
}
