<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'total_member_count'];


    public function users(): HasMany
    {
        return $this->hasMany('users', 'user_id', 'channel_id');
    }
}
