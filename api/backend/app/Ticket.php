<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
     //$fillable make the columns mass assignable. 
      protected $fillable = ['title', 'content', 'slug', 'status', 'user_id'];

      //Alternatively, you may use the $guarded property to make all attributes mass assignable except for your chosen attributes. For example, I use the id column here:
      //protected $guarded = ['id'];


      public function user()
      {
          return $this->belongsTo('App\User');
      }

      public function getTitle()
      {
          return $this->title
      }

     // protected $table = 'yourCustomTableName';
}
