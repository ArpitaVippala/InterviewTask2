<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

class CommentsModel extends Model
{
    use Notifiable;
    protected $table ='comments';
    public $timestamps = false;
    protected $guarded = [];
}
