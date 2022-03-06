<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Majors;
class Students extends Model
{
    protected $fillable = [
        'name',
        'email',
        'major_id',
        'dob',
        'address',
        'phone',
        'created_at',
        'updated_at'
    ];
    public function major(){

        return $this->belongsTo('App\Majors');
    }
}