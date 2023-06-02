<?php

namespace App\Models\Subject;

use App\Models\Academic\Classes;
use App\Models\Academic\Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssignClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
