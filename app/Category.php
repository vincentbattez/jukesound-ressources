<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table      = "jukesound_RES_categories";
    public    $timestamps = false;

    public function item() {
        return $this->hasMany("App\Item", "id_category");
        /*
            SELECT * FROM jukesound_RES_items
            WHERE jukesound_RES_items.id_category = $this->id
        */
    }
}
