<?php
    /**
    * Variables
    *
    * @var $categories           @type [{}]      @mean All categories
    * @var $category->name       @type String    @mean Name of category
    *
    * @var $item->id               @type Number    @mean id of resource
    * @var $item->category->name   @type String    @mean Name of category
    * @var $item->name             @type String    @mean Name of resource
    * @var $item->slug             @type String    @mean Slug of resource
    * @var $item->quantity         @type Number    @mean Quantity dispo
    * @var $item->quantity_jukebox @type Number    @mean Quantity for 1 jukebox
    * @var $item->quantity_buy     @type Number    @mean Quantity for 1 achat
    * @var $item->url              @type String    @mean Url for buy ressource
    * @var $item->image            @type String    @mean path image of ressource
    */
    $currentPage = [
        'title' => 'Modifier "'. $item->name .'" - Jukesound Ressource',
        'bodyClass' => 'edit'
    ];
?>
@extends('layouts.app')

{{----------------
    HEADER
----------------}}
@section('main-header')
<div class="header--bg header" style="background-image:url({{ asset('images/bg-header-create.jpg') }});">
    <div class="container">
        <h1 class="h1"><span class="bar-bg-title">Éditer "{{$item->name}}"</span></h1>
    </div>
</div>
@endsection
{{----------------
    CONTENT
----------------}}
@section('content')
    <section class="container">
        <h2 class="h2">Modifier les informations de "{{$item->name}}"</h2>
        {!! Form::model($item->id, [
                'route'  => ['items.update', $item->id], 
                'action' => 'ItemsController@update',
                'method' => 'PUT',
                'id'     => 'editForm'
            ])
        !!}

            <article class="js-category" id="ressource-category">
                {{--  Category  --}}
                <div class="form-row align-items-center" id="category-container">
                    <div class="form-group">
                        <label for="selectCategory">Catégorie de la ressource</label>
                        <div class="title-category">
                            {!! Form::text('inputCategory', $item->category->name, [
                                'list' => 'categoriesData',
                                'class' => 'form-control',
                                'placeholder' => 'Interfaces',
                                'required'
                                ])
                            !!}
                            <datalist id="categoriesData">
                                <label for="selectCategory" class="form-control">ou sélectionner dans la liste</label>
                                <select id="selectCategory">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->name}}">
                                    @endforeach
                                </select>
                            </datalist>
                        </div> 
                    </div>
                </div>
                <div id="ressource-container">
                    {{--  Ressource 1  --}}
                    <div class="ressource form-row align-items-center js-ressource" id="{{$item->slug}}">
                        <div class="form-group">
                            <div class="file-container">
                                {{--  FILE  --}}
                                <label for="image">Image</label>
                                {!! Form::file('image', ['id' => 'image']) !!}                                
                                <label class="input-file" for="image">
                                    <img src="{{url($item->image)}}" class="outputImg active"/>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{--  NOM  --}}
                            <label for="name">Nom de la ressource</label>
                            {!! Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'Bouton poussoir', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {{--  MAKE  --}}
                            <label for="make">Quantité pour fabriquer un Jukebox</label>
                            {!! Form::number('make', $item->quantity_jukebox, ['class' => 'form-control', 'id' => 'make', 'placeholder' => '8', 'required', 'min' => 1]) !!}
                        </div>
                        <div class="form-group">
                            {{--  ACHAT  --}}
                            <label for="buy">Quantité lors d'un achat</label>
                            {!! Form::number('buy', $item->quantity_buy, ['class' => 'form-control', 'id' => 'buy', 'placeholder' => '8', 'required', 'min' => 1]) !!}
                        </div>
                        <div class="form-group">
                            {{--  PRICE  --}}
                            <label for="buy">Prix de l'achat</label>
                            {!! Form::number('price', $item->price, ['class' => 'form-control', 'id' => 'price', 'placeholder' => '21', 'required', 'min' => 0, 'step'=>'any']) !!}
                        </div>
                        <div class="form-group">
                            {{--  LIEN  --}}
                            <label for="link">Lien achat</label>
                            {!! Form::url('link', $item->url, ['class' => 'form-control', 'id' => 'link', 'placeholder' => 'https://www.amazon.fr/nom', 'required']) !!}
                        </div>
                    </div>
                </div>
            </article>
            <hr>
            {{--  SUBMIT  --}}
            {!! Form::button('Valider', ['class' => 'btn btn-success', 'id'=> 'launchEdit' ,'type' => 'submit']) !!}
        {!! Form::close() !!}
    </section>
@endsection
