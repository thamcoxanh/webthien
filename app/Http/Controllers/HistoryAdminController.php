<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
class HistoryAdminController extends Controller
{
  public function manager() {




      $allPaypal = History::join('users', 'users.id', '=', 'histories.user_id')->join('products', 'products.id', '=', 'histories.product_id')->select('users.*','histories.price','histories.id','products.name as pname')->orderBy('histories.id', 'desc')->paginate(10);

      $arr_paypal = [];
      foreach ($allPaypal->items() as $key => $value) {
          $arr_paypal[$key] =
            [
              'id' => $value->id,
              'name' => $value->name,
              'email' => $value->email,
              'type' => $value->type,
              'service' => $value->service,
              'phone' => $value->phone,
              'price' => $value->price,
              'pname' => $value->pname,
            ];
      }
      $data = array(
          'title'=>'Admin - Manager History Buy',
          'menu' => 'history',
          'allPaypal' => $arr_paypal,
          'paginator' => $allPaypal
        );
      return view('admin.history_admin_manager', $data);
  }
}
