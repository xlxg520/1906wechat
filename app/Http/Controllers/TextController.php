<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TextController extends Controller
{
   public function getAccessToken()
   {

       $url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx1c2d3bdcfe3a747c&secret=65bca24ff0d89b7901e915967af766e6";
       $json = file_get_contents($url);
       $arr = json_decode($json,true);
       echo $json;echo '</br>';
       echo '<pre>';print_r($arr);echo '</pre>';
   }




}
