<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleHasPermission;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['group_id','name'];

    public function permissionCheck($role,$permission)
    {
        $find = RoleHasPermission::where(['role_id'=>$role,'permission_id'=>$permission])->first();
        if($find){
            return true;
        }else{
            return false;
        }
    }
}
