<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Output extends CI_Output {
 
 /**
  * Deletes an output cache file from a given uri
  *
  * @access public
  * @param string
  * @return bool
  */
 public function delete_cache($uri = '', $cache_append_path = null)
 {
  $CI =& get_instance();
  $path = $CI->config->item('cache_path');
  
  $cache_path = (($path == '') ? APPPATH.'cache/' : $path) . ($cache_append_path == null ? '' : $cache_append_path);

  $uri = $CI->config->item('base_url').
    $CI->config->item('index_page').
    $uri;

  $cache_path .= preg_replace ('/\/|:|\./i', '_', $uri);

  log_message("debug", sprintf("%s %s: clear cache from %s", __CLASS__, __FUNCTION__, $cache_path));
  if (is_file($cache_path)) {
    $r = unlink($cache_path);
    log_message("debug", sprintf("%s %s: remove %s.", __CLASS__, __FUNCTION__, ($r)?"ok":"failed"));
    return $r;
  }
  log_message("debug", sprintf("%s %s: no file from %s", __CLASS__, __FUNCTION__, $cache_path));
  return false;
 }
 /**
  * Deletes all output cache file from a given uri
  *
  * @access public
  * @param string
  * @return bool
  */
 public function delete_all_cache($cache_append_path = null)
 {
  if (!isset ($cache_append_path) || !is_string ($cache_append_path)) return false;

  $CI =& get_instance();
  $path = $CI->config->item('cache_path');
  
  $cache_path = (($path == '') ? APPPATH.'cache/' : $path) . ($cache_append_path == null ? '' : $cache_append_path);
  
  $CI->load->helper ('directory');
  return directory_delete (FCPATH . $cache_path);
 }
}
// END MY Output Class

/* End of file MY_Output.php */
/* Location: ./application/core/MY_Output.php */ 