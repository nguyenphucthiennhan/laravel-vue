<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{
    protected $table = "usersauth";
    protected $fillable = ['name', 
    'email',
    'password'];

    use HasFactory;
}
