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
    protected $appends = [
        'list_price',
    ];

    public function category() {
        return $this->belongsTo("App\Category", "id_category");
    }

    // LISTE DES PRIX
    public function getListPriceAttribute() {
        $price    = $this->price;
        $unitaire = unitPrice($price, $this->quantity_buy);
        $rest     =
            ($this->quantity >= $this->quantity_jukebox)
                ? 0
                : $unitaire * ($this->quantity_jukebox - $this->quantity);

        $prices = (object) [
            'price'    => (object) [
                'full'    => $price,
                'decimal' => priceDecimal($price),
                'centime' => priceCentime($price),
            ],
            'unitaire' => (object) [
                'full'    => $unitaire,
                'decimal' => priceDecimal($unitaire),
                'centime' => priceCentime($unitaire),
            ],
            'rest'     => (object) [
                'full'    => $rest,
                'decimal' => priceDecimal($rest),
                'centime' => priceCentime($rest),
            ],
        ];

        return $prices;
    }
}
