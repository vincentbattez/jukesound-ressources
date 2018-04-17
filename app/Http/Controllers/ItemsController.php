<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class ItemsController extends Controller
{
    /*———————————————————————————————————*\
                    INDEX
    \*———————————————————————————————————/*
        @type      [View]

        @return    Display toutes les ressources trié par catégorie 

        @location  /resources/views/Items/index.blade.php
    */
    public function index() {
        $items      = Item::all();     // @return GET all resources
        $categories = Category::all(); // @return GET all categories
        /**
         *
         *  @return Function nb Jukebox réalisable
         *
         */
        $nbJukeboxRealisable = 0;
        $x = 1;
        for ($i=0; $i < sizeof($items); $i++) {
            if (sizeof($items) == $i+1) { // dernière itération

                if ($items[$i]->quantity < $items[$i]->quantity_jukebox * $x) { // pas assez de ressources
                    break;
                }
                $i=0;
                $x++;
                $nbJukeboxRealisable++;
            }

            if ($items[$i]->quantity < $items[$i]->quantity_jukebox * $x) { // pas assez de ressources
                break;
            }
        }
        /**
         *
         *  @return View resources + all categories + nb jukebox réalisable
         *
         *  @location views/Items/index.blade.php
         *
         */
        return view('items.index', [
            'items'               => $items,
            'categories'          => $categories,
            'nbJukeboxRealisable' => $nbJukeboxRealisable
        ]);
    }

    /*———————————————————————————————————*\
                    CREATE
    \*———————————————————————————————————/*
        @type     [View]

        @return   retourne la vue pour créer une ressource / categorie
        
        @location /resources/views/Items/create.blade.php

    */
    public function create() {
        /**
         *
         *  @return GET all categories
         *
         */
        $categories = Category::all(); // @return GET all categories
        
        return view('items.create', [
            'categories' => $categories
        ]);
    }

    /*———————————————————————————————————*\
                    EDIT
    \*———————————————————————————————————/*
        @type     [View]

        @params   $id ID de l'item

        @return   Show the form for editing the specified resource

        @location /resources/views/Items/edit.blade.php
    */
    public function edit($id) {
        /**
         *
         *  @return GET resources by id
         *
         */
        $item = Item::findOrFail($id); // @return GET all categories
        /**
         *
         *  @return GET all categories
         *
         */
        $categories = Category::all(); // @return GET all categories
        /**
         *  @return View
         */
        return view('items.edit', [
            'item'       => $item,
            'categories' => $categories
        ]);
    }

    /*———————————————————————————————————*\
                    STORE
    \*———————————————————————————————————/*
        @type   [Create]
        
        @params $request get data from forms

        @return Stock un nouvel items dans la BDD
    */
    public function store(Request $request, Item $items) {
        $items = new Item();

        $name             = $request->input('name');
        $image            = $request->input('image');
        $quantity_jukebox = $request->input('quantity_jukebox');
        $quantity_buy     = $request->input('quantity_buy');
        $url              = $request->input('url');
        $category         = $request->input('inputCategory');

        echo '<pre>';
        var_dump($name);
        echo '</pre>';

        // $items->save();
    }

    /*———————————————————————————————————*\
                    INCREMENT
    \*———————————————————————————————————/*
        @type     [Update]
        
        @params   $id      ID de l'item
        @params   $request get data from forms

        @return   Incrémente la quantité de stock de l'item

        @redirect items.index
    */
    public function increment($id, Request $request) {
        /**
         *
         *  @return UPDATE increment item
         *
         */
        Item::find($id)->increment('quantity', $request->input('nbAdd'));
        
        return redirect::route('items.index');
    }

    /*———————————————————————————————————*\
                    DECREMENT
    \*———————————————————————————————————/*
        @type     [Update]
        
        @params   $id      ID de l'item
        @params   $request get data from forms

        @return   Décremente la quantité de stock de l'item

        @redirect items.index
    */
    public function decrement($id, Request $request) {
        /**
         *
         *  @return UPDATE decrement item
         *
         */
        Item::find($id)->decrement('quantity', $request->input('nbRemove'));
        
        return redirect::route('items.index');
    }

    /*———————————————————————————————————*\
                    UPDATE
    \*———————————————————————————————————/*
        @type     [Update]
        
        @params $request get data from forms

        @return Update the specified resource in storage
    */
    public function update(Request $request, Item $items) {
    }

    /*———————————————————————————————————*\
                    MAKEJUKEBOX
    \*———————————————————————————————————/*
        @type     [Delete]
        
        @params   $request get data from forms

        @return   Incrémente la quantité de stock de tous les items

        @redirect items.index
    */
    public function makeJukebox(Request $request) {
        /**
         *
         *  @return GET all resources
         *
         */
        $items = Item::all();
        /**
         *
         *  @return DELETE decrement all ressources
         *
         */
        foreach ($items as $k => $item) {
            $nbRemove = $item->quantity_jukebox * $request->input('nbMakeJukebox');
            Item::find($item->id)->decrement('quantity', $nbRemove);
        }
        return redirect::route('items.index');
    }

    /*———————————————————————————————————*\
                    DESTROY
    \*———————————————————————————————————/*
        @type     [Delete]
        
        @params   $id      ID de l'item

        @return   Supprime de la table l'item & l'image assosié
        @return   Supprime la catégorie de l'item si il n'y a plus d'item dans la catégorie & le dossier image assosié
        
        @redirect items.index
    */
    public function destroy($id) {
        /**
         * @return id Selectionee l'id de la catégorie de l'article que l'on veut supprimer 
         */
        $items = Item::select('id_category')->whereId($id)->get();
        $id_category = $items[0]->id_category;
        /**
         * @return Number Nombre de même catégorie 
         */
        $nbSameCategory = Item::whereId_category($id_category)->count();

        $folder = 'images/'.Item::first()->category->name;
        $image  = Item::whereId($id)->first()->image;

        /**
         * @return DELETE Supprime de la table l'item et l'image
         */
        Item::whereId($id)->delete();
        File::delete($image);
        /**
         * Si il n'y a plus d'item dans la catégorie
         */
        if ($nbSameCategory === 1) {
            /**
             * @return DELETE Supprime la catégorie de l'item
             */
            Category::whereId($id_category)->delete();
            File::deleteDirectory($folder);
        }
        return redirect::route('items.index');
    }
}