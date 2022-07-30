<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExport extends Model
{
    use HasFactory;
    protected $table = "user_exports";
    protected $fillable = ['id', 'user_id', 'type', 'path', 'split'];
}
