<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class BannedPostsModel extends Model
{
    use Notifiable;
    protected $table = 'banned_users_posts';
    public $timestamps = false;

    protected $guarded = [];
}
