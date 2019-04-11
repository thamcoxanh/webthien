<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;

class CategorysController extends Controller
{
    public function index($id)
    {
        $category = Category::where('parent_id', '=', $id)->orderBy('id')->get();

        $data_return = [];
        foreach ($category as $keyCategory => $valueCategory) {

            $allProduct = Product::where('category_id', '=', $valueCategory->id)->orderBy('id')->get();
            $arr_category = [];
            foreach ($allProduct as $key => $value) {
              $image = explode('||', $value->images);
              foreach ($image as $index => $item) {
                $image[$index] = 'http://thienyoga.net'.$item;
              }
              $arr_category[$key] =
              [
                'id' => $value->id,
                'name' => $value->name,
                'description' => $value->description,
                'price' => $value->price,
                'type' => $value->type,
                'time_play' => $value->time_play,
                'icon' => 'http://thienyoga.net'.$value->icon,
                'images' =>  $image,
                'file' => 'http://thienyoga.net'.$value->file
              ];
            }

            $data_return[$keyCategory] = ["category" => $valueCategory->name , "category_id" => $valueCategory->id , 'category_des' => $valueCategory->description , "items" => $arr_category];

        }
        return $data_return;
    }
    public function show($id)
    {
    	$category = Category::find($id);
    	$data_return = [];
    	$allProduct = Product::where('category_id', '=', $id)->orderBy('id')->get();
    	$arr_category = [];
    	foreach ($allProduct as $key => $value) {
	       	$image = explode('||', $value->images);
	       	foreach ($image as $index => $item) {
	       		$image[$index] = 'http://thienyoga.net'.$item;
	       	}
          	$arr_category[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,
              'description' => $value->description,
              'price' => $value->price,
              'type' => $value->type,
              'time_play' => $value->time_play,
              'icon' => 'http://thienyoga.net'.$value->icon,
              'images' =>  $image,
              'file' => 'http://thienyoga.net'.$value->file
            ];
	    }
	    $data_return = ["category" => $category->name , "category_id" => $category->id , "items" => $arr_category];
        return $data_return;
    }


}
