<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

class PostsModel extends Model
{
    use Notifiable;
    protected $table = 'posts';
    public $timestamps = false;
    protected $guarded = [];
}
