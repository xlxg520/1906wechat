<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TextController extends Controller
{
   public function getAccessToken()
   {
       $redis_weixin_token_key = 'weixin_access_token';
        //判断是否 有缓存
       $token = Redis::get($redis_weixin_token_key);
       if($token){

           return $token;
       }else{
           //获取 微信access_token
           $url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx1c2d3bdcfe3a747c&secret=65bca24ff0d89b7901e915967af766e6";
           $json = file_get_contents($url);
           $arr = json_decode($json,true);
           $toekn = $arr['access_token'];
       }

       //缓存token
       Redis::set($redis_weixin_token_key,$arr['access_token']);
       Redis::expire($redis_weixin_token_key,7200);
       return $token;
   }



   // 获取用户信息
    public function getUserInfo()
    {
        $access_token = $this->getAccessToken();
        $openid  = 'opvtsw9wwRs4RqC-bFUBj2jwMtas';

        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $json = file_get_contents($url);
        $arr  =  json_decode($json,true);
        echo '<pre>';print_r($arr);echo '</pre>';
    }

}
