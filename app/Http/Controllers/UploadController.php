<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Item;
use App\Category;
use DB;


class UploadController extends Controller {

	/*———————————————————————————————————*\
									imageItem
	\*———————————————————————————————————/*
					@type      [Create]
					@method    POST
	
					@params    $id   ID du user
						
					@return    Upload l'image de la ressource
					@location  /resources/views/items/index.blade.php
	*/
	public function imageItem(){
		if(Input::hasFile('image')) {
			$images       = Input::file('image');
			$categoryName = Input::get('inputCategory');
			$categorySlug = str_slug($categoryName, '-');
			// dd($getCategory);
			foreach ($images as $key => $image) {
				$getCategory  	 = Category::where('slug', $categorySlug)->first();
				$extension       = '.'.$image->getClientOriginalExtension();
				$imageName       = str_slug(Input::get('name')[$key]).$extension;
				$imagePath       = 'images/'.$categorySlug.'/';
				
				$itemName        = Input::get('name')[$key];

				$quantityJukebox = Input::get('make')[$key];
				$quantityBuy     = Input::get('buy')[$key];
				
				$url             = Input::get('link')[$key];


				if($getCategory) {
					// La category existe déjà
					$idCategory = $getCategory->id;
				}else{
					$newCategory = Category::updateOrCreate(
						[
							'name' => $categoryName,
							'slug' => $categorySlug,
						]
					);
					$idCategory = $newCategory->id;
				}
				Item::updateOrCreate(
					[
						'id_category'      => $idCategory,
						'name'             => $itemName,
						'slug'             => str_slug($itemName),
						'image'            => $imagePath.$imageName,
						'quantity'         => 0,
						'quantity_jukebox' => $quantityJukebox,
						'quantity_buy'     => $quantityBuy,
						'url'              => $url,
					]
				);

				$image->move($imagePath, $imageName);
			}

			return redirect()->route('items.index');
		}
		else{
			return back()->withInput();
		}
  }
	
}