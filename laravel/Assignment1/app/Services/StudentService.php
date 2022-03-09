<?php
namespace App\Services;

use App\Contracts\Dao\StudentDaoInterface;
use Illuminate\Http\Request;
use App\Contracts\Services\StudentServiceInterface;

class StudentService implements StudentServiceInterface {

    private $studentDao;
    public function __construct(StudentDaoInterface $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    public function getAll(){
        return $this->studentDao->getAll();
    }

    public function getMajor(){

        return $this->studentDao->getMajor();
    }

    public function update($request,$student){

        return $this->studentDao->update($request, $student);
    }

    public function create(Request $request){

        return $this->studentDao->create($request);

    }
    public function delete($student){
        return $this->studentDao->delete($student);
    }
    public function search(Request $request) {
        return $this->studentDao->search($request);
    }
}
