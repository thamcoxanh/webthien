<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;

use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserAdminController extends Controller
{
  public function __construct() {

  }

  public function manager() {




      $allUser = User::join('profiles', 'users.id', '=', 'profiles.user_id')->select('users.*','profiles.address', 'profiles.phone', 'profiles.price')->orderBy('users.id', 'desc')->paginate(10);
      $arr_user = [];
      foreach ($allUser->items() as $key => $value) {
          $arr_user[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,
              'email' => $value->email,
              'type' => $value->type,
              'service' => $value->service,
              'address' => $value->address,
              'phone' => $value->phone,
              'price' => $value->price,
            ];
      }
      $data = array(
          'title'=>'Admin - Manager Users',
          'menu' => 'user',
          'menu_item' => 'user-manager',
          'allUser' => $arr_user,
          'paginator' => $allUser
        );
      return view('admin.user_admin_manager', $data);
  }
  public function update($id) {
      $users = User::findOrFail($id);
      $profile = Profile::where('user_id', '=', $id)->first();
      //User::where('email', '=', $email)->update(['remember_token' => $time]);

      $data = array(
          'title'=>'Admin - Update Users',
          'menu' => 'user',
          'menu_item' => 'user-manager',
          'user' => $users,
          'profile' => $profile
        );
      return view('admin.user_admin_update', $data);
  }
  public function update_success(Request $request ,$id) {

      $users = User::findOrFail($id);
      $profile = Profile::where('user_id', '=', $id)->first();
      $data = $request->data;
      $users->name = $data['name'];
      $users->email = $data['email'];
      if($data['password'] != '' && strlen($data['password']) >= 8  ){
          $users->password = Hash::make($data['password']);
      }

      $users->type = $data['type'];
      $users->save();

      $profile->address = $data['address'];
      $profile->phone = $data['phone'];
      $profile->price = $data['price'];
      $profile->save();
      return redirect('/admin/user-manager');
  }
  public function create_success(Request $request) {

      $data_create = $request->data;
      if($data_create){

          if($data_create['password'] == '' || strlen($data_create['password']) < 8){
            $data = array(
              'title'=>'Admin - Create Users',
              'menu' => 'user',
              'menu_item' => 'user-create',
              'data' => $data_create,
              'errors' => 'Password must be greater than 8 characters'
            );
            return view('admin.user_admin_create', $data);
          }else if($data_create['email'] == ''){
              $data = array(
                'title'=>'Admin - Create Users',
                'menu' => 'user',
                'menu_item' => 'user-create',
                'data' => $data_create,
                'errors' => 'Email not empty'
              );
              return view('admin.user_admin_create', $data);
          }
          $user = User::where('email', '=', $data_create['email'])->first();
          if($user){
            $data = array(
              'title'=>'Admin - Create Users',
              'menu' => 'user',
              'menu_item' => 'user-create',
              'data' => $data_create,
              'errors' => 'Email exists'
            );
            return view('admin.user_admin_create', $data);
          }

          User::insert(['name' => $data_create['name'],'email' => $data_create['email'],'password' => Hash::make($data_create['password']),'type' => $data_create['type'] , 'service' => 'website']);
          $user = User::where('email', '=', $data_create['email'])->first();
          Profile::insert(['user_id' => $user->id,'address' => $data_create['address'],'phone' => $data_create['phone'],'price' => $data_create['price']]);
          return redirect('/admin/user-manager');
      }else{
          $data = array(
            'title'=>'Admin - Create Users',
            'menu' => 'user',
            'menu_item' => 'user-create',
            'data' => '',
            'errors' => ''
          );
          return view('admin.user_admin_create', $data);
      }
  }
  public function delete($id) {
      $users = User::findOrFail($id);
      $profile = Profile::where('user_id', '=', $id)->first();
      $users->delete();
      $profile->delete();

      return redirect('/admin/user-manager');
  }
}
