<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
// delete but not permanently method update the deleted at time
    use SoftDeletes;
    Protected  $dates = ['deleted_at'];


    //
    // Protected $table = 'posts';
    // Protected $primaryKey = 'post_id';

    // createnew
    Protected $fillable = [
        'title',
        'content',
        'users_count',
        'is_admin'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }




   
}
