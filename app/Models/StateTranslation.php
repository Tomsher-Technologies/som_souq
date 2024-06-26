<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'state_id'];

  public function state(){
    return $this->belongsTo(State::class);
  }
}
