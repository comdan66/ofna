<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Clean_caches extends Admin_controller {
  private $caches = null;

  public function __construct () {
    parent::__construct ();
    $this->caches = array (
      array ('main_index_about', '首頁', array ('main_index', 'about')),
      array ('pictures', '瀑布流', array ('pictures')),
      array ('pictures_disable', '瀑布流 停止頁', array ('pictures', 'disable')),
      array ('google_map_beigang_319', '19 地圖', array ('google_map', 'beigang_319')),
      array ('google_map_beigang_320', '20 地圖', array ('google_map', 'beigang_320')),
      array ('main_index_others', '使用說明', array ('main_index', 'others')),
      );
  }

  public function index ($submenu_num = 0) {
    $data['objects'] = array ();

    if (count ($this->caches)) {
      foreach ($this->caches as $cache) {
        $object = array (
          'key' => $cache[0],
          'name' => $cache[1],
          'url' => base_url ($cache[2]),
          'file_name' => preg_replace ('/\/|:|\./i', '_', base_url ($cache[2])));
        array_push ($data['objects'], json_decode (json_encode ($object), false));
      }
    }
    $data['delete_url'] = base_url (array ('admin', $this->get_class (), 'delete'));
    $this->load_view ($data);
  }

  public function delete ($key) {
    if (!verifyString ($key)) redirect (array ('admin', $this->get_class (), 'index'));

    if ($this->is_ajax (false)) {
      delay_request ('delay_jobs', 'delete_cache_by_key', array ('key' => $key));
      $this->output_json (array ('status' => true, 'title' => '成功', 'message' => '刪除成功!', 'action' => 'function(){window.location.assign ("' . base_url (array ('admin', $this->get_class (), 'index')) . '");}'));
    } else { 
      $this->add_hidden ('delete_url', 'delete_url', base_url (array ('admin', $this->get_class (), $this->get_method (), $key)))->load_view ();
    }
  }
}
