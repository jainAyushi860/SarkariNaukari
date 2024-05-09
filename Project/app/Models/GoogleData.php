<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleData extends Model
{
    use HasFactory;
    protected $table = 'signup';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'token',
        'google_id'
    ];
}
