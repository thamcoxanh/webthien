<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
class ProductAdminController extends Controller
{
  public function manager() {



      $allCategory = Product::orderBy('id', 'desc')->paginate(10);

      $arr_category = [];
      foreach ($allCategory->items() as $key => $value) {
          $name_parent = "";
          if($value->category_id != null){
              $parent = Category::findOrFail($value->category_id);
              @$name_parent = $parent->name;
          }
          $arr_category[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,
              'description' => $value->description,
              'price' => $value->price,
              'type' => $value->type,
              'price_paypal' => $value->price_paypal,
              'icon' => $value->icon,
              'category_name' => $name_parent,
            ];
      }
      $data = array(
          'title'=>'Admin - Manager Product',
          'menu' => 'product',
          'menu_item' => 'product-manager',
          'allUser' => $arr_category,
          'paginator' => $allCategory
        );
      return view('admin.product_admin_manager', $data);
  }
  public function update($id) {
      $this_category = Product::findOrFail($id);
      $category = Category::all();
      //User::where('email', '=', $email)->update(['remember_token' => $time]);
      $this_category->images = explode('||', $this_category->images);
      if (! is_array($this_category->images)) {
          $this_category->images = array();
      }
      $this_category->images = array_pad($this_category->images, 50, null);

      $data = array(
          'title'=>'Admin - Update Product',
          'menu' => 'product',
          'errors' => '',
          'menu_item' => 'product-manager',
          'data' => $this_category,
          'allcategory' => $category
        );
      return view('admin.product_admin_update', $data);
  }
  public function update_success(Request $request ,$id) {

      $this_category = Product::findOrFail($id);
      $data = $request->data;

      if (is_array($data['images'])) {
          foreach ($data['images'] as $index => $image) {
              if (null == $image) {
                  unset($data['images'][$index]);
              } else {
                  $data['images'][$index] = $image;
              }
          }
      }
      $this_category->images = implode('||', $data['images']);


      $this_category->name = $data['name'];
      $this_category->category_id = $data['category_id'];
      $this_category->price = $data['price'];
      $this_category->type = $data['type'];
      $this_category->icon = $data['icon'];

      $this_category->file = $data['file'];
      $this_category->price_paypal = $data['price_paypal'];
      $this_category->description = $data['description'];
      $this_category->time_play = $data['time_play'];
      $this_category->save();


      return redirect('/admin/product-manager');
  }
  public function create_success(Request $request) {

      $data_create = $request->data;
      if($data_create){
        if (is_array($data_create['images'])) {
            foreach ($data_create['images'] as $index => $image) {
                if (null == $image) {
                    unset($data_create['images'][$index]);
                } else {
                    $data_create['images'][$index] = $image;
                }
            }
        }
          Product::insert(
              [
                  'category_id' => $data_create['category_id'],
                  'name' => $data_create['name'],
                  'description' => $data_create['description'],
                  'file' => $data_create['file'],
                  'price' => $data_create['price'],
                  'type' => $data_create['type'],
                  'price_paypal' => $data_create['price_paypal'],
                  'time_play' => $data_create['time_play'],
                  'icon' => $data_create['icon'],
                  'images' => implode('||', $data_create['images'])
              ]);
          return redirect('/admin/product-manager');
      }else{
          $category = Category::all();
          $this_category = [];
          $data = array(
              'title'=>'Admin - Insert Product',
              'menu' => 'product',
              'errors' => '',
              'menu_item' => 'product-create',
              'data' => $this_category,
              'allcategory' => $category
            );
          return view('admin.product_admin_create', $data);
      }
  }
  public function delete($id) {
      $category = Product::findOrFail($id);
      $category->delete();

      return redirect('/admin/product-manager');
  }
}
