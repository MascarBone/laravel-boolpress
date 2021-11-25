<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','image_url','user_id','content','post_date','category_id'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    // public function user() {
    //     return $this->belongsTo('App\User');
    // }
    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'post_tag');
    }

    public function getImgUrl() {
        return str_starts_with($this->image_url, 'uploads/')  ? asset('storage/') . '/' : "" ;
    }
}
