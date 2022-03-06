<?php
namespace App\Dao;

use App\Majors;
use App\Students;
use App\Contracts\Dao\StudentDaoInterface;
use Illuminate\Http\Request;

class StudentDao implements StudentDaoInterface{

    private $model;

    public function __construct(Students $model)
    {
        $this->model = $model;
    }
    public function getAll(){

        return $this->model->with("major")->latest()->get();
    }

    public function getMajor(){

        return $this->model = Majors::orderBy("name")->get()->pluck("name", "id");
    }
    public function create(Request $request){
        return $this->model->create($request->all());
    }

    public function update($request,$student){
       return $student->update($request->all());
    }

    public function delete($student){
        return $student->delete();
    }
}