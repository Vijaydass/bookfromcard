<?php

if ( !function_exists('amazon_url'))
{
    function amazon_url($str, $starting_word){
        $arr = explode($starting_word, $str);
        if (isset($arr[1])){
          $url = strlen($arr[1])-10;
          return substr($arr[1], 0, -$url);
        }
        return $str;
    }
}

if(!function_exists('get_user')){

    function get_user($id){
      return  $result = DB::table('users')->where(['id'=>$id])->first();
      // ->whereNull('deleted_at')
    }

}
?>