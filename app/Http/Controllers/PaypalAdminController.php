<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal;
class PaypalAdminController extends Controller
{
  public function manager() {




      $allPaypal = Paypal::join('users', 'users.id', '=', 'paypals.user_id')->select('users.*','paypals.price','paypals.id')->orderBy('paypals.id', 'desc')->paginate(10);

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
            ];
      }
      $data = array(
          'title'=>'Admin - Manager Paypal',
          'menu' => 'paypal',
          'allPaypal' => $arr_paypal,
          'paginator' => $allPaypal
        );
      return view('admin.paypal_admin_manager', $data);
  }
}
