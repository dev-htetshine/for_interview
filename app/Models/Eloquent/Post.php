<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\Models\Eloquent\User', 'created_user_id');
    }
}
