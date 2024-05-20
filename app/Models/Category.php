<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Cache;

class Category extends Model
{

    protected $fillable = [
        'parent_id',
        'en_name',
        'ar_name',
        'so_name',
        'icon',
        'slug',
        'is_active',
    ];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? getActiveLanguage() : $lang;

        if ($lang !== false) {
            $field = $lang.'_' . $field;
        }

        return $this->$field;
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

   
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }
    public function child()
    {
        return $this->hasMany(Category::class,'parent_id')->with('child')->select('id','parent_id','name','level','slug');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function icon()
    {
        return $this->hasOne(Upload::class, 'id', 'icon');
    }

    public function getMainCategory()
    {
        $parent = $this->parentCategory;
        while($parent->parent_id != 0) {
            $parent = $parent->parentCategory;
        }
        return $parent->id;
    }

    public static function boot()
    {
        static::creating(function ($model) {
            Cache::forget('categories');
        });

        static::updating(function ($model) {
            Cache::forget('categories');
        });

        static::deleting(function ($model) {
            Cache::forget('categories');
        });

        parent::boot();
    }
}
