<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class PermissionGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function permission($id)
    {
        return Permission::where('group_id',$id)->get();
    }
}
