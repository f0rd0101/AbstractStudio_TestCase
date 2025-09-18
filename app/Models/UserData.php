<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserData extends Model
{
   protected $fillable = ['name','email','user_id'];
   public function user(){
     return $this->belongsTo(User::class);
   }
}
