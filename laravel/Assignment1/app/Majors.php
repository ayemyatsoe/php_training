<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Students;
class Majors extends Model
{
    public function student(){

        return $this->hasOne('App\Students');
}
}