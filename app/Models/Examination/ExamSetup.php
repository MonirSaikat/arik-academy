<?php

namespace App\Models\Examination;

use App\Models\Subject\Subject;
use App\Models\Academic\Classes;
use App\Models\Examination\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamSetup extends Model
{
    use HasFactory;

    protected $guearded = ['id'];
    
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
