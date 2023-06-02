<?php

namespace App\Models\Academic;

use App\Models\Academic\Group;
use App\Models\Subject\Subject;
use App\Models\Academic\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function section()
    {
        return $this->belongsToMany(Section::class,'class_section_assigns','class_id','section_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class,'class_assign_groups','class_id','group_id');
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class,'subject_assign_classes','class_id','subject_id');
    }

    public function hasClasses($id)
    {
        $has = ClassAssignGroup::where('class_id',$id)->count();
        $response = false;
        if($has > 0){
            $response = true;
        }
        return $response;
    }
    
}
