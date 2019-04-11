<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
class JwtController extends Controller
{
      public function login(Request $request)
     {
         //return User::find(1);
         if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

              $user = User::where('email', '=', $request->email)->first();

              $key = "luunguyenthanh91@gmail.com";
              $token = array(
                  "iss" => $user->email,
                  "aud" => $user->password,
                  "iat" => 979313050,
                  "nbf" => time()
              );
              $jwt = JWT::encode($token, $key);
              $user_jwt = DB::table('jwts')->where('user_id', '=', $user->id)->first();
              if($user_jwt){
                  DB::table('jwts')->where('user_id', '=', $user->id)->update(['token' => $jwt]);
              }else{
                  DB::table('jwts')->insert(['token' => $jwt,'user_id' => $user->id]);
              }

              //$decoded = JWT::decode($jwt, $key, array('HS256'));
              //$json = array(
                  //"id" => $user->id,
                  //"name" => $user->name,
                  //"email" => $user->email,
                  //"type" => $user->type,
                  //"service" => $user->service,
              //);
              $json = array("token" => $jwt);
              return json_encode($json);
         }else{
            $json = array("errors" => "Login False");
            return json_encode($json);
         }
     }

     public function checkToken(Request $request)
     {
         $header = $request->header('Authorization');
         $jwt = DB::table('jwts')->where('token', '=', $header)->first();
         if($jwt){
              $user = User::join('profiles', 'users.id', '=', 'profiles.user_id')->select('users.*','profiles.address', 'profiles.phone', 'profiles.price')->where('users.id', '=', $jwt->user_id)->first();
              $json = array(
                  "id" => $user->id,
                  "name" => $user->name,
                  "email" => $user->email,
                  "phone" => $user->phone,
                  "address" => $user->address,
              );
              return json_encode($json);

         }else{
              $json = array("errors" => "Token False");
              return json_encode($json);
         }

     }

     public function register(Request $request)
     {
         $name = $request->name;
         $email = $request->email;
         $password = Hash::make($request->password);
         $type = "default";
         $service = "website";
         $user = User::where('email', '=', $email)->first();
         if($user){
             $json = array("errors" => "Email Exists");
             return json_encode($json);
         }else{
              User::insert(['name' => $name,'email' => $email,'password' => $password,'type' => $type , 'service' => $service]);

              $key = "luunguyenthanh91@gmail.com";
              $token = array(
                  "iss" => $email,
                  "aud" => $password,
                  "iat" => 979313050,
                  "nbf" => time()
              );
              $jwt = JWT::encode($token, $key);
              $user_create = User::where('email', '=', $email)->first();

              Profile::insert(['user_id' => $user_create->id]);
              DB::table('jwts')->insert(['token' => $jwt,'user_id' => $user_create->id]);

              $json = array("token" => $jwt);
              return json_encode($json);
         }

     }

     public function resetPassword(Request $request)
     {

          $email = $request->email;
          $time = time();
          $to      = $email;
          User::where('email', '=', $email)->update(['remember_token' => $time]);
          $subject = 'Quên Mật Khẩu';
          $message = 'Vui lòng nhập mã code này khi thay đổi mật khẩu' . $time;
          $headers = 'From: mediation.chakra@gmail.com' . "\r\n" .
              'Reply-To: mediation.chakra@gmail.com' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
          $json = array("message" => "Mail Send Success");
          return json_encode($json);
     }

     public function confirmResetPassword(Request $request)
     {
         $email = $request->email;
         $code = $request->code;
         $password = $request->password;
         $user = User::where('email', '=', $email)->first();
         if($user){
              if($user->remember_token == $code && $code != ""){
                  User::where('email', '=', $email)->update(['password' => Hash::make($password),"remember_token" => ""]);
                  $json = array("message" => "Update Password Success");
                  return json_encode($json);
              }else{
                  $json = array("errors" => "Code in email not exists");
                  return json_encode($json);
              }
         }else{
             $json = array("errors" => "Email not exists");
             return json_encode($json);
         }
     }
}
