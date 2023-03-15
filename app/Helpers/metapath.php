<?php
use Illuminate\Support\Arr;

if (!function_exists('meta_img_path')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function meta_img_path($img_tag)
    {
      preg_match( '@src="([^"]+)"@' , $img_tag, $result );
      $img_path = array_pop($result);
      return $img_path;
    }
}

if (!function_exists('extract_img_alt')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function meta_img_alt($img_tag)
    {
      preg_match( '@alt="([^"]+)"@' , $img_tag, $result );
      $img_path = array_pop($result);
      return $img_path;
    }
}

if (!function_exists('extract_file_name_from_path')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function extract_file_name_from_path($path)
    {
      $arr = explode('/', $path);
      $key = array_key_last($arr);

      return $arr[$key];
    }
}
