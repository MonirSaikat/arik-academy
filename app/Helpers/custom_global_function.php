<?php

use App\Models\Examination\Exam;
use App\Models\Examination\ExamSetupTitle;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permission;
use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\RoleHasPermission;
use App\Models\UserHasRole;
use App\Models\Examination\Grade;
use App\Models\Examination\Mark;
use App\Models\UserInformation;
use Illuminate\Support\Facades\DB;

function settings() {
    return DB::table('phones')->first();
}

function getOrdinalNumber($number) {
    $suffixes = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if (($number % 100) >= 11 && ($number % 100) <= 13) {
        return $number . 'th';
    } else {
        return $number . $suffixes[$number % 10];
    }
}

    function userHasPermission($permission){
            
            $user = auth()->user()->id;
            $role = UserHasRole::where('user_id',$user)->first();

            $permission = Permission::where('name',$permission)->first();
            if($permission && $role)
            {
                $valide = RoleHasPermission::where(['role_id'=>$role->role_id,'permission_id'=>$permission->id])->first();
                if($valide){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }


    }

    function hasNotPermission(){
        return abort(500, "you has not permission");
    }

    function branchName(){
        return Auth()->user()->branch_id;
    }

    function examination($id){
        return Exam::find($id)->name;
    }

    function examsetuptitle(){
        return ExamSetupTitle::all();
    }
    
    function students(){
        return Student::count();
    }
    
    function grade()
    {
        return Grade::orderBy('gpa','desc')->get();
    }
    function subjects($details){
        return Subject::join('subject_assign_classes','subject_assign_classes.subject_id','subjects.id')
            ->where('subject_assign_classes.class_id',$details['class_id'])
            ->where('subject_assign_classes.group_id',$details['group_id'])
            ->get();
    }

    function mark($id){
        return Mark::join('students','students.id','marks.student_id')
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->join('grades','grades.id','marks.grade_id')
                ->where('students.id',$id)
                ->select('exam_setups.subject_id as subject_id','marks.total_marks as mark','grades.gpa as gpa',
                    'grades.name as grade','subjects.type as type','subjects.subject_code as subject_code')
                ->get();
    }


