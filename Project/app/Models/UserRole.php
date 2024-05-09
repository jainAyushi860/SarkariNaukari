<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddRole;

class UserRole extends Model
{
    use HasFactory;

    protected $table = "userrole";

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'roles',
        'status',
       
       // 'google_id',
        
    ];


    public function addrole()
    {
        return $this->belongsTo(AddRole::class);
    }
}
