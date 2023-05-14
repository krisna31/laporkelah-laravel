<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public static $IS_SUPERADMIN = 1, $IS_ADMIN = 2, $IS_USER = 3;
}
