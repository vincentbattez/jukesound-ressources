<?php
    /**
    * Variables
    *
    * @var $categories           @type [{}]      @mean All categories
    * @var $category->name       @type String    @mean Name of category
    *
    * @var $items                        @type [{}]      @mean All resources
    * @var $item->id                     @type Number    @mean id of resource
    * @var $item->name                   @type String    @mean Name of resource
    * @var $item->slug                   @type String    @mean Slug of resource
    * @var $item->quantity               @type Number    @mean Quantity dispo
    * @var $item->quantity_jukebox       @type Number    @mean Quantity for 1 jukebox
    * @var $item->quantity_buy           @type Number    @mean Quantity for 1 achat
    * @var $item->url                    @type String    @mean Url for buy ressource
    * @var $item->image                  @type String    @mean path image of ressource
    *
    * @var $item->item->category->name   @type String    @mean Name of category
    * @var $item->item->category->name   @type String    @mean Name of category
    */

    $currentPage = [
        'title' => 'Liste des ressources - Jukesound Ressource',
        'bodyClass' => 'items'
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
                    <div class="form-inline">
                        <div class="form-group input-btn">
                            <input type="number" name="nbSimulateJukebox" class="form-control" value="{{$nbJukeboxRealisable}}" min="1">
                            <button type="submit" name="startSimulation" class="btn btn-success">Lancer la simulation</button>
                        </div>
                    </div>

                    {!! Form::model($items, [
                        'route'  => ['items.makeJukebox'], 
                        'action' => 'ItemsController@makeJukebox',
                        'method' => 'POST',
                        'class'  => 'form-inline',
                        'id'     => 'productionForm'
                    ])
                !!}
                    <div class="form-group input-btn">
                        {!! Form::number('nbMakeJukebox', 1, ['class' => 'form-control', 'id' => 'nbMakeJukebox', 'required', 'min' => '0', 'max' => $nbJukeboxRealisable]) !!}
                        {!! Form::button('Lancer la fabrication du Jukebox', ['class' => 'btn btn-success', 'id'=> 'launchProduction' ,'type' => 'submit']) !!}
                    </div>
                    {!! Form::close() !!}
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
                @if($item->category->name == $category->name)
                    <div class="card card--{{ $item->quantity >= $item->quantity_jukebox ? 'success' : 'danger' }}" id="{{$item->slug}}"> 

                        <div class="card__image">
                            <img src="{{ asset($item->image) }}" alt="image de la ressource {{$item->name}}">
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
                            <p class="card__title">{{$item->name}}</p>
                        </div>
                        

                        <div class="card__actions">
                            {!! Form::model($items, [
                                    'route'  => ['items.increment', $item->id], 
                                    'action' => 'ItemsController@increment',
                                    'class'  => 'form-inline',
                                    'method' => 'PUT',
                                    'id'     => 'incrementForm'
                                ])
                            !!}
                                <div class="form-group input-btn">
                                    {!! Form::number('nbAdd', $item->quantity_buy, ['class' => 'form-control', 'required', 'min' => '1']) !!}
                                    {!! Form::button('Ajouter', ['class' => 'btn btn-success', 'id' => 'incrementSubmit', 'type' => 'submit']) !!}
                                </div>
                            {!! Form::close() !!}
                            
                            {!! Form::model($items, [
                                    'route'  => ['items.decrement', $item->id], 
                                    'action' => 'ItemsController@decrement',
                                    'class'  => 'form-inline',
                                    'method' => 'PUT',
                                    'id'     => 'decrementForm'
                                ])
                            !!}
                                <div class="form-group input-btn">
                                    {!! Form::number('nbRemove', $item->quantity_jukebox, ['class' => 'form-control', 'required', 'min' => '1', 'max' => $item->quantity]) !!}
                                    {!! Form::button('Supprimer', ['class' => 'btn btn-danger', 'id' => 'decrementSubmit', 'type' => 'submit']) !!}
                                </div>
                            {!! Form::close() !!}


                            <div class="card__price">
                                <span class="price">
                                    <span class="price__decimal">{{$item->decimal}}</span><span class="price__separator">.</span><span class="price__centime">{{$item->centime}}</span> <span class="price__devise">€</span>
                                </span>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @icon('more','icon-more')
                                </button>
                                {{--  MENU DROPDOWN  --}}
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('items.edit', $item->id) }}">@icon('edit','icon-edit')</a>
                                    <a class="dropdown-item" target="_blank" href="{{$item->url}}">@icon('shop','icon-shop')</a>


                                    {!! Form::model($items, [
                                            'route'  => ['items.destroy', $item->id], 
                                            'action' => 'ItemsController@destroy',
                                            'method' => 'DELETE',
                                            'id'     => 'destroyForm',
                                            'class'  => 'destroyForm'
                                        ])
                                    !!}
                                        <button class="dropdown-item bg-danger deleteRessource" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer {{$item->name}} ?')">@icon('delete','icon-delete')</button>
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