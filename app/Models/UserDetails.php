<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = ['name','email','phone','education','gender','image','user_id','status','referral_id','address'];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function forumPost(){
        return $this->hasMany('App\Models\KnowledgeForumPost');
    }
    public function board()
    {
        return $this->belongsTo(Board::class,'assign_board_id','id');
    }
    public function assignClass()
    {
        return $this->belongsTo(AssignClass::class,'assign_class_id','id');
    }
    public function assignSubject()
    {
        return $this->belongsTo(AssignSubject::class,'assign_subject_id','id');
    }
}
