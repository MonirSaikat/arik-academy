<?php

namespace App\Models\Academic;

use App\Models\Subject\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subject()
    {
        return $this->belongsToMany(Subject::class,'subject_assign_classes','group_id','subject_id');
    }
}
