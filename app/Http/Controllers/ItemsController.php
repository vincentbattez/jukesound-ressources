<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         *
         *  @GET all resources
         *
         */
        $items = DB::table('jukesound_RES_items')
            ->join('jukesound_RES_categories', 'jukesound_RES_categories.id', '=', 'jukesound_RES_items.id_category')
            ->select(
                'jukesound_RES_categories.name as categoryName',
                'jukesound_RES_items.name as itemName',
                'jukesound_RES_items.quantity',
                'jukesound_RES_items.quantity_jukebox',
                'jukesound_RES_items.quantity_achat',
                'jukesound_RES_items.id'
            )
            ->orderBy('categoryName')
            ->get()
        ;
        /**
         *
         *  @GET all categories
         *
         */
        $categories = DB::table('jukesound_RES_items')
            ->join('jukesound_RES_categories', 'jukesound_RES_categories.id', '=', 'jukesound_RES_items.id_category')
            ->select('jukesound_RES_categories.name')
            ->groupBy('jukesound_RES_categories.name')
            ->orderBy('jukesound_RES_categories.name')
            ->get()
        ;
        /**
         *
         *  @FUNCTION nb Jukebox réalisable
         *
         */
        $nbJukeboxRealisable = 0;
        $x = 1;
        for ($i=0; $i < sizeof($items); $i++) {
            if ($items[$i]->quantity < $items[$i]->quantity_jukebox * $x) { // pas assez de ressources
                break;
            }
            if (sizeof($items) == $i+1) { // dernière itération
                $nbJukeboxRealisable++;
                $i=0;
                $x++;
            }
        }

        /**
         *
         *  @return all resources + all categories
         *
         *  @location views/Items/index.blade.php
         *
         */
        return view('items.index', [
            'items' => $items,
            'categories' => $categories,
            'nbJukeboxRealisable' => $nbJukeboxRealisable
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('items.create', [
            //'items' => $items,
            //'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items) {
        return view('items.edit', compact('items'));
    }

    public function countIncrement($id){
        DB::table('jukesound_RES_items')
                                        ->where('jukesound_RES_items.id', $id)
                                        ->increment('quantity', 2);
        return redirect::route('items.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items) {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items) {
        $items->delete();
        return redirect::route('items.index');
    }
}
