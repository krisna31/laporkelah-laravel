<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public static $IS_CLOSE = 0;
    public static $IS_OPEN = 1;
    protected $guarded = ['id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upvoteUsers()
    {
        return $this->belongsToMany(User::class, 'upvote_report', 'report_id', 'user_id');
    }
}
