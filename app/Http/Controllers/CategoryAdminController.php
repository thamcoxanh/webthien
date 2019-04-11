<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use Illuminate\Support\Facades\DB;


class CategoryAdminController extends Controller
{
  public function manager() {




      $allCategory = Category::orderBy('id', 'desc')->paginate(10);

      $arr_category = [];
      foreach ($allCategory->items() as $key => $value) {
          $name_parent = "";
          if($value->parent_id != null){
              $parent = Category::findOrFail($value->parent_id);
              @$name_parent = $parent->name;
          }
          $arr_category[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,
              'description' => $value->description,
              'parent_id' => $value->parent_id,
              'parent_name' => $name_parent,
            ];
      }
      $data = array(
          'title'=>'Admin - Manager Category',
          'menu' => 'category',
          'menu_item' => 'category-manager',
          'allUser' => $arr_category,
          'paginator' => $allCategory
        );
      return view('admin.category_admin_manager', $data);
  }
  public function update($id) {
      $this_category = Category::findOrFail($id);
      $category = Category::where('parent_id', null)->get();
      //User::where('email', '=', $email)->update(['remember_token' => $time]);

      $data = array(
          'title'=>'Admin - Update Users',
          'menu' => 'category',
          'errors' => '',
          'menu_item' => 'user-manager',
          'data' => $this_category,
          'allcategory' => $category
        );
      return view('admin.category_admin_update', $data);
  }
  public function update_success(Request $request ,$id) {

      $this_category = Category::findOrFail($id);
      $data = $request->data;


      $this_category->name = $data['name'];
      $this_category->description = $data['description'];
      $this_category->parent_id = $data['parent_id'];
      $this_category->save();


      return redirect('/admin/category-manager');
  }
  public function create_success(Request $request) {

      $data_create = $request->data;
      if($data_create){
          Category::insert(['name' => $data_create['name'],'parent_id' => $data_create['parent_id'],'description' => $data_create['description']]);
          return redirect('/admin/category-manager');
      }else{
          $category = Category::where('parent_id', null)->get();
          $data = array(
            'title'=>'Admin - Create Category',
            'menu' => 'category',
            'menu_item' => 'category-create',
            'data' => '',
            'errors' => '',
            'allcategory' => $category,
          );
          return view('admin.category_admin_create', $data);
      }
  }
  public function delete($id) {
      $category = Category::findOrFail($id);
      $category->delete();
      $category = Category::where('parent_id', $id)->get();
      foreach ($category as $key => $value) {
        $value->delete();
      }
      return redirect('/admin/category-manager');
  }
}
