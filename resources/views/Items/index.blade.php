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

<div class="header--bg header--big header" style="background-image:url({{ asset('images/bg-header-list.jpg') }});">
    <div class="container">
        <h1><span class="bar-bg-title">Gestion de ressources</span><span class="d-block"> Jukesound</span></h1>
        <div class="header__white-block">
            <div class="header__white-content">
                <div class="header__white-content__text">
                    <span class="display-1 primary">{{$nbJukeboxRealisable}}</span>
                    <span class="display-2">Jukebox réalisable</span>
                </div>
                <div class="header__white-content__action">
                    <form class="form-inline" action="#" method="POST">
                        <div class="form-group input-btn">
                            <input type="number" name="nbSimulateJukebox" class="form-control" value="{{$nbJukeboxRealisable}}" min="1">
                            <button type="submit" name="startSimulation" class="btn btn-success">Lancer la simulation</button>
                        </div>
                    </form>
                    <form class="form-inline" action="#" method="POST">
                        <div class="form-group input-btn">
                            <input type="number" name="nbMakeJukebox" class="form-control" value="1" min="1" max="{{$nbJukeboxRealisable}}">
                            <button type="submit" name="startMake" class="btn btn-success">Lancer la fabrication du Jukebox</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
{{----------------
    CONTENT
----------------}}
@section('content')
<section class="container">
    <h2 class="h2">Liste des ressources</h2>
    @foreach($categories as $category)
    <section class="section-category" aria-label="Catégorie : {{$category->name}}">
        <button class="title-category" data-toggle="collapse" href="#collapse{{$category->name}}" role="button" aria-expanded="true" aria-controls="collapse{{$category->name}}">
            <h3 class="h3">{{$category->name}}</h3>
        </button>
        <div class="list-card collapse show" id="collapse{{$category->name}}">
            @foreach($items as $item)
            @if($item->categoryName == $category->name)
                <div class="card card--{{ $item->quantity >= $item->quantity_jukebox ? 'success' : 'danger' }}"> 

                    <div class="card__image">
                        <img src="{{ asset('images/category-interface/bouton-rond.jpg') }}" alt="categorie: {{$category->name}}, ressource: {{$item->itemName}}">
                    </div>

                    <div class="card__stock">
                        @icon('stock','icon-stock')
                        <p class="stock">
                            <span class="stock__value">{{$item->quantity}}</span>
                            /
                            <span class="stock__quantity-jukebox">{{$item->quantity_jukebox}}</span>
                        </p>
                    </div>

                    <div class="card__content">
                        <p class="card__title">{{$item->itemName}}</p>
                    </div>

                    <div class="card__actions">


                        {!! Form::model($items, [
                                'route' => ['items.countIncrement', $item->id], 
                                'action' => 'ItemsController@countIncrement',
                                'class' => 'form-inline',
                                'method' => 'PUT'
                            ])
                        !!}
                            <div class="form-group input-btn">
                                {!! Form::number('nbAdd', $item->quantity_jukebox, ['class' => 'form-control', 'required', 'min' => '1']) !!}
                                {!! Form::button('Ajouter', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                            </div>
                        {!! Form::close() !!}
                        <form class="form-inline" action="#" method="POST">
                            <div class="form-group input-btn">
                                <input type="number" name="nbRemove" class="form-control" value="{{$item->quantity_jukebox}}">
                                <button type="submit" name="removeResource" class="btn btn-danger">Supprimer</button>
                            </div>
                        </form>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @icon('more','icon-more')
                            </button>
                            {{--  MENU DROPDOWN  --}}
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('items.edit', $item->id) }}">@icon('edit','icon-edit')</a>
                                <a class="dropdown-item" target="_blank" href="https://amazon.fr">@icon('shop','icon-shop')</a>

                                {!! Form::open(array('route' => ['items.destroy', $item->id], 'method' => 'DELETE')) !!}
                                    <button class="dropdown-item bg-danger" type="submit">@icon('delete','icon-delete')</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </section>
    @endforeach

</section>
@endsection