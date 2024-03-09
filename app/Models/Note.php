<?php

namespace App\Models;

use App\Traits\HasUuidPK;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes, HasUuidPK;

    protected $fillable = ['id', 'title', 'description', 'user_id', 'image_url', 'pinned_at'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
