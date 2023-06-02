<?php

namespace App\Models\Examination;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subject()
    {
        return $this->belongsTo(ExamSetup::class, 'exam_setup_id','id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
