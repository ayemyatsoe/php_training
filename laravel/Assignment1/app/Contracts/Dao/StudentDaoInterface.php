<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface StudentDaoInterface {

    public function getAll();

    public function getMajor();

    public function update($request,$student);

    public function create(Request $request);

    public function delete($student);

    public function search(Request $request);
}