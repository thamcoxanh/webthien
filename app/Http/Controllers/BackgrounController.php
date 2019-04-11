<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Background;
class BackgrounController extends Controller
{
  public function index()
  {
      $all_background = Background::all();
      $return = [];
      foreach ($all_background as $index => $background) {
        $data_return = [];
        $background->images = explode('||', $background->images);
        foreach ($background->images as $key => $value) {
            $value  = explode('--', $value);
            $data_return[$key] = ["url" => 'http://thienyoga.net'.$value[0],"width" => $value[1],"height" => $value[2]];
        }
        $return[$index] = ["id"=>$background->id,"name" => $background->name , "images" => $data_return];
      }
      return  $return;
  }
  public function show($id)
  {
      $background = Background::find($id);
      $data_return = [];
      $background->images = explode('||', $background->images);
      foreach ($background->images as $key => $value) {
          $value  = explode('--', $value);
          $data_return[$key] = ["url" => 'http://thienyoga.net'.$value[0],"width" => $value[1],"height" => $value[2]];
      }

      return $data_return;
  }
}
