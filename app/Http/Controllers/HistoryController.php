<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use Illuminate\Support\Facades\DB;

use Stripe\Stripe;
use Stripe\Charge;
class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $data_create = $request;
        $user = DB::table('users')->where('email', '=', $data_create['email'])->first();
        $product = History::where([['user_id', '=', $user->id],['product_id', '=', $data_create['product_id']]])->first();
        if($product){
            return 1;
        }else{
          return 0;
        }
    }

    public function show(Request $request)
    {
        $data_create = $request;
        $user = DB::table('users')->where('email', '=', $data_create['email'])->first();
        $product = History::where([['user_id', '=', $user->id]])->join('products', 'products.id', '=', 'histories.product_id')->select('products.*')->get();
        $arr_category = [];
        foreach ($product as $key => $value) {
          $value['icon'] = 'http://thienyoga.net'.$value['icon'];
          $arr_category[$key] = $value;
        }


        return $arr_category;

    }

    public function store(Request $request)
    {
        $data_create = $request;
        \Stripe\Stripe::setApiKey("pk_test_iEJ4ow3sCW6q2oLKIUY4CXHy");
        try {
          \Stripe\Charge::create([
            "amount" => $data_create['price'],
            "currency" => "vnd",
            "source" => $data_create['token_id'], // obtained with Stripe.js
            "description" => "Thanh Toan"
          ]);
          $user = DB::table('users')->where('email', '=', $data_create['email'])->first();
          History::insert(['user_id' => $user->id,'product_id' => $data_create['product_id'],'price' => $data_create['price']]);

        } catch(\Stripe\Error\Card $e) {
          return 0;
        } catch (\Stripe\Error\RateLimit $e) {
          return 0;
        } catch (\Stripe\Error\InvalidRequest $e) {
          return 0;
        } catch (\Stripe\Error\Authentication $e) {
          return 0;
        } catch (\Stripe\Error\ApiConnection $e) {
          return 0;
        } catch (\Stripe\Error\Base $e) {
          return 0;
        } catch (Exception $e) {
          return 0;
        }

    }

    public function update(Request $request)
    {
        $data_create = $request;

        $user = DB::table('users')->where('email', '=', $data_create['email'])->first();
        History::insert(['user_id' => $user->id,'product_id' => $data_create['product_id'],'price' => $data_create['price']]);

        return 200;

    }

    public function delete(Request $request, $id)
    {
        $article = History::findOrFail($id);
        $article->delete();

        return 204;
    }
}
