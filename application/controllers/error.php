<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Error extends Error_controller {
  public function __construct () {
    parent::__construct ();
    
  }

  public function index ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '不明原因錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function incomplete_post_params ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => 'Ajax 資料傳輸錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function api_request ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '解譯結果 API 處現錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function oauth_incomplete_params ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '第三方認證資訊錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function oauth_facebook_incomplete_vars ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => 'Facebook API 取得資料、處現錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else { redirect (array ('pictures')); }
      // $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));}
  }

  public function oauth_facebook_get_data ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => 'Facebook API 取得資料錯誤，請通知程式設計人員!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function oauth_facebook_unknown ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => 'Facebook API 取得資料錯誤，message: ' . $message, 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function no_sign_in ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '您可能還沒登入喔，請快登入吧!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function not_ajax ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '這不是你該來的地方喔!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function not_post ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '這不是你該來的地方喔!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function punish ($message = '') {
    $data = array ('status' => false, 'title' => '錯誤!', 'message' => '你目前被水桶!', 'action' => 'function(){location.reload();}');
    if ($this->is_ajax (false)) $this->output_json ($data, config ('d4_config', 'static_page_cache_time'));
    else $this->set_method ('index')->load_view ($data, false, config ('d4_config', 'static_page_cache_time'));
  }
}
