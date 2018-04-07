<?php
    /**
    * Variables
    *
    * @var $categories           @type [{}]      @mean All categories
    * @var $category->name       @type String    @mean Name of category
    */
    $currentPage = [
        'title' => 'Créer une nouvelle ressource - Jukesound Ressource',
        'bodyClass' => 'create'
    ];
?>
@extends('layouts.app')

{{----------------
    HEADER
----------------}}
@section('main-header')
<div class="header--bg header" style="background-image:url({{ asset('images/bg-header-create.jpg') }});">
    <div class="container">
        <h1 class="h1"><span class="bar-bg-title">Ajouter une ressource</span></h1>
    </div>
</div>
@endsection
{{----------------
    CONTENT
----------------}}
@section('content')
    <section class="container">
        <h2 class="h2">Ajouter une ou plusieurs ressources</h2>
        <form action="./create.blade.php" method="post">

            <article class="js-category" id="category1">
                {{--  Category  --}}
                <div class="form-row align-items-center" id="category-container">
                    <div class="form-group">
                        <label for="selectCategory">Catégorie de la ressource</label>
                        <div class="title-category">
                            <input list="categoriesData" name="inputCategory" class="form-control" placeholder="Interfaces" required>
                            <datalist id="categoriesData">
                                <label for="selectCategory" class="form-control">ou sélectionner dans la liste</label>
                                <select name="selectCategory" id="selectCategory">
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
                    <div class="ressource form-row align-items-center js-ressource" id="ressource1">
                        <div class="form-group">
                            <div class="file-container">
                                {{--  FILE  --}}
                                <label class="" for="image1">Image</label>
                                <input type="file" name="image[]" id="image1" required>
                                <label class="input-file" for="image1"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{--  NOM  --}}
                            <label for="name1">Nom de la ressource</label>
                            <input type="text" id="name1" class="form-control" name="name[]" placeholder="Bouton poussoir" required>
                        </div>
                        <div class="form-group">
                            {{--  MAKE  --}}
                            <label for="make1">Quantité pour fabriquer un Jukebox</label>
                            <input type="number" id="make1" class="form-control" name="make[]" placeholder="8" required min="1">
                        </div>
                        <div class="form-group">
                            {{--  ACHAT  --}}
                            <label for="buy1">Quantité lors d'un achat</label>
                            <input type="number" id="buy1" class="form-control" name="buy[]" placeholder="50" required min="1">
                        </div>
                        <div class="form-group">
                            {{--  LIEN  --}}
                            <label for="link1">Lien achat</label>
                            <input type="url" id="link1" class="form-control" name="link[]" placeholder="https://amazon.fr" required>
                        </div>
                    </div>
                    <button class="btn-add-ressource d-flex js-addForm">
                        <span class="btn-circle add"></span>
                        <span>Ajouter une ressource de la même catégorie</span>
                    </button>
                </div>
            </article>
            <hr>
            {{--  SUBMIT  --}}
            <button type="submit" class="btn btn-primary">Ajouter ressources</button>
        </form>
    </section>
@endsection
