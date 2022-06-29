<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = ['name','email','phone','education','gender','image','user_id'];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id',  'id');
    }

    public function forumPost(){
        return $this->hasMany('App\Models\KnowledgeForumPost');
    }
}
