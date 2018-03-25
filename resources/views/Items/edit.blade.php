<?php
    /**
    * Variables
    *
    * @var $categories           @type [{}]      @mean All categories
    * @var $category->name       @type String    @mean Name of category
    *
    * @var $items                  @type [{}]      @mean All resources
    * @var $item->id               @type Number    @mean id of resource
    * @var $item->categoryName     @type String    @mean Name of category
    * @var $item->itemName         @type String    @mean Name of resource
    * @var $item->quantity         @type Number    @mean Quantity dispo
    * @var $item->quantity_jukebox @type Number    @mean Quantity for 1 jukebox
    * @var $item->quantity_achat   @type Number    @mean Quantity for 1 achat
    */

    $currentPage = [
        'title' => 'Liste des ressources - Jukesound Ressource',
        'bodyClass' => 'dasboard'
    ];
?>
@extends('layouts.app')

{{----------------
    HEADER
----------------}}
@section('main-header')

@endsection