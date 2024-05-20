<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $state_translations = $this->hasMany(StateTranslation::class)->where('lang', $lang)->first();
        return $state_translations != null ? $state_translations->$field : $this->$field;
    }

    public function state_translations(){
       return $this->hasMany(StateTranslation::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
}
