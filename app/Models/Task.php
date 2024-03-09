<?php

namespace App\Models;

use App\Traits\HasUuidPK;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, HasUuidPK;
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'note_id',
        'parent_id',
    ];
}
