<?php

namespace App\Models\Student;

use App\Models\Academic\Classes;
use App\Models\Academic\Group;
use App\Models\Academic\Section;
use App\Models\Academic\Session;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
  use HasFactory;

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $guard = 'student';

  protected $guarded = ['id'];

  protected $fillable = [
    'student_unique_id', 'roll_number', 'name', 'father_name', 'mother_name', 'parent_phone', 'student_phone', 'class_id', 'group_id', 'session_id', 'section_id', 'gender', 'religion', 'blood_group', 'date_of_birth', 'birth_certificate_number', 'photo', 'village', 'post', 'upozila', 'district', 'parmanent_village', 'parmanent_post', 'parmanent_upozila', 'parmanent_district', 'is_active', 'password', 'user_id',
  ];

  function class()
  {
    return $this->belongsTo(Classes::class)->withDefault(['name' => 'N/A']);
  }
  public function group()
  {
    return $this->belongsTo(Group::class)->withDefault(['name' => 'N/A']);
  }
  public function session()
  {
    return $this->belongsTo(Session::class)->withDefault(['name' => 'N/A']);
  }
  public function section()
  {
    return $this->belongsTo(Section::class)->withDefault(['name' => 'N/A']);
  }

  public function religion()
  {
    return $this->belongsTo(Religion::class)->withDefault(['name' => 'N/A']);
  }

  /**
   * Get the gender that owns the Student
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function gender(): BelongsTo
  {
    return $this->belongsTo(Gender::class, 'gender', 'id')->withDefault(['name' => 'N/A']);
  }
}
