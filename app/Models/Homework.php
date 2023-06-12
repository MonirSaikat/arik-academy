<?php

namespace App\Models;

use App\Models\Academic\Classes;
use App\Models\Subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $table = "homework";

    protected $guarded = ['id'];

    function user() {
        return $this->belongsTo(User::class);
    }
    function class(){
        return $this->belongsTo(Classes::class,'class_id','id');
    }
    function subject() {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}

