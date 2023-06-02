<?php

namespace App\Models\Academic;

use App\Models\Academic\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassAssignGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
