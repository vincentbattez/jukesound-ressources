<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table    = "jukesound_RES_items";
    protected $fillable = [
        'id_category',
        'name',
        'slug',
        'quantity',
        'quantity_jukebox',
        'quantity_buy',
        'price',
        'url',
        'image',
    ];
    protected $appends = ['decimal'];

    public function category() {
        return $this->belongsTo("App\Category", "id_category");
    }

    // DECIMAL
    public function getDecimalAttribute() {
            $hasPoint = str_contains($this->price, '.');

            if($hasPoint) {
                return intval(str_before($this->price, '.'));
            }else {
                return $this->price;
            }
    }

    // CENTIME
    public function getCentimeAttribute() {

        $hasPoint = str_contains($this->price, '.');
        $centime = intval(str_after($this->price, '.'));
            
        if($hasPoint) {
            if ($centime < 10) {
                return '0'.$centime;
            }else {
                return $centime;
            }
        }else {
            return '00';
        }
    }
}
