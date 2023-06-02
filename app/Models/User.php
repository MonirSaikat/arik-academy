<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ClientUserAssign;
use App\Models\UserInformation;
use App\Models\Student\Student;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'username',
    'mobile_number',
    'password',
    'branch_id',
    'is_teacher',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function client()
  {
    return $this->hasOne(ClientUserAssign::class);
  }

  public function information()
  {
    return $this->hasone(UserInformation::class);
  }

  public function permission($role, $permission)
  {

  }
  public function role()
  {
    return $this->hasOne(UserHasRole::class);
  }

  public function student()
  {
    return $this->hasOne(Student::class);
  }
}
