<?php

namespace App\Models\Fee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


}
