<?php

namespace App\Models\Subject;

use App\Models\Academic\Group;
use App\Models\SubjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject_type()
    {
        return $this->belongsTo(SubjectType::class,'type','id');
    }
}
