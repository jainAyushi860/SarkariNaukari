<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;

class AddRole extends Model
{
    use HasFactory;
    protected $table="addrole";
    protected $fillable = [
        'id',
        'name',
        'permissions',
    ];

    public function userrole()
    {
        return $this->hasMany(UserRole::class,'roles','id');
    }
}
