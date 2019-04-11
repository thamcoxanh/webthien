<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Background;
use Illuminate\Support\Facades\DB;
class BackgrounAdminController extends Controller
{

  public function manager() {



      $allCategory = Background::orderBy('id', 'desc')->paginate(10);

      $arr_category = [];
      foreach ($allCategory->items() as $key => $value) {
          $name_parent = "";

          $arr_category[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,

            ];
      }
      $data = array(
          'title'=>'Admin - Manager Background',
          'menu' => 'background',
          'menu_item' => 'background-manager',
          'allUser' => $arr_category,
          'paginator' => $allCategory
        );
      return view('admin.background_admin_manager', $data);
  }
  public function update($id) {
      $this_category = Background::findOrFail($id);
      $this_category->images = explode('||', $this_category->images);
      if (! is_array($this_category->images)) {
          $this_category->images = array();
      }else{
          $images_all = [];
          foreach ($this_category->images as $key => $value) {
              $value  = explode('--', $value);
              $images_all[$key] = ["url" => $value[0],"width" => $value[1],"height" => $value[2]];
          }

          $this_category->images = $images_all;
          $this_category->images = array_pad($this_category->images, 50, null);
      }

      $data = array(
          'title'=>'Admin - Update Background',
          'menu' => 'background',
          'errors' => '',
          'menu_item' => 'background-manager',
          'data' => $this_category
        );
      return view('admin.background_admin_update', $data);
  }
  public function update_success(Request $request ,$id) {

      $this_category = Background::findOrFail($id);
      $data = $request->data;

      if (is_array($data['images'])) {
          foreach ($data['images'] as $index => $image) {
              if (null == $image['url']) {
                  unset($data['images'][$index]);
              } else {
                  $data['images'][$index] = implode('--', $image);
              }
          }
      }
      $this_category->images = implode('||', $data['images']);


      $this_category->name = $data['name'];
      $this_category->save();


      return redirect('/admin/background-manager');
  }
  public function create_success(Request $request) {

      $data_create = $request->data;

      if($data_create){
        if (is_array($data_create['images'])) {
            foreach ($data_create['images'] as $index => $image) {
                if (null == $image['url']) {
                    unset($data_create['images'][$index]);
                } else {
                    $data_create['images'][$index] = implode('--', $image);
                }
            }
          }

          Background::insert(
              [
                  'name' => $data_create['name'],
                  'images' => implode('||', $data_create['images'])
              ]);
          return redirect('/admin/background-manager');
      }else{
          $this_category = [];
          $data = array(
              'title'=>'Admin - Insert Background',
              'menu' => 'background',
              'errors' => '',
              'menu_item' => 'background-create',
              'data' => $this_category,
            );
          return view('admin.background_admin_create', $data);
      }
  }
  public function delete($id) {
      $category = Background::findOrFail($id);
      $category->delete();

      return redirect('/admin/background-manager');
  }
}
