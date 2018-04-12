<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table      = "jukesound_RES_items";
    public    $timestamps = false;
    public function category() {
        return $this->belongsTo("App\Category", "id_category");
        /*
            SELECT * FROM jukesound_RES_items
            WHERE jukesound_RES_items.id_category = $this->id
        */
    }
}
