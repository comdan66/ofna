<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

include_once ('path_helper.php');

if (!function_exists ('verifyDimension')) {
  function _get_config_recursive ($item) {
    $levels = array (); for ($i = 1; ($i < func_num_args ()) && verifyString ($level = func_get_arg ($i)); $i++) array_push ($levels, $level);
    if (count ($levels)) {
      if (verifyString ($index_name = array_shift ($levels)) && isset ($item[$index_name]) && verifyNotNull ($item = $item[$index_name])) {
        if (verifyArray ($item)) { array_unshift ($levels, $item); return call_user_func_array ('_get_config_recursive', $levels); }
        else if ((verifyString ($item) || verifyNumber ($item) || verifyBoolean ($item)) && !count ($levels)) { return $item; }
        else { return null; }
      } else { return null; }
    } else { return $item; }
  }
}

if (!function_exists ('config')) {
  function config () {
    $levels = array (); for ($i = 0; ($i < func_num_args ()) && verifyString ($level = func_get_arg ($i)); $i++) array_push ($levels, $level);
    if (count ($levels) && verifyString ($config_name = array_shift ($levels)) && verifyFileReadable ($path = FCPATH . APPPATH . 'config' . DIRECTORY_SEPARATOR . $config_name . EXT)) {
      require ($path);
      if (verifyArray ($config_name = $$config_name)) { array_unshift ($levels, $config_name); return call_user_func_array ('_get_config_recursive', $levels); }
      else { return null; }
    } else { return null; }
  }
}
