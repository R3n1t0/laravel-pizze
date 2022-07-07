<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pizza extends Model
{

  

    protected $fillable = [

        'nome',
        'slug',
        'prezzo',
        'ingredienti',
        'vegetariana'

    ];


    public static function generateSlug($nome){
        $slug = Str::slug($nome, '-');
        $base_slug = $slug;
        $take_slug = Pizza::where('slug', $slug)->first();
        $i = 1;
        while ($take_slug) {
            $slug = $base_slug . '-' . $i ;
            $i++;
            $take_slug = Pizza::where('slug', $slug)->first();
        }
        return $slug;
    }
}
