<?php

namespace App\Models\Teacher;

use App\Models\Setting\Department;
use App\Models\Subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subject()
    {
        return $this->belongsToMany(Subject::class,'subject_assign_teachers','teacher_id','subject_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
