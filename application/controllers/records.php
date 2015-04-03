<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Records extends Site_controller {
  public function __construct () {
    parent::__construct ();
  }

  public function create_like_count () {
    if (!$this->is_ajax ()) redirect (array ('error', 'not_ajax'));
    $url = $this->input_post ('url');
    delay_request ('delay_jobs', 'create_like_count', array ('url' => $url));
    $this->output_json (array ('status' => true));
  }

  public function remove_like_count () {
    if (!$this->is_ajax ()) redirect (array ('error', 'not_ajax'));
    $url = $this->input_post ('url');
    delay_request ('delay_jobs', 'remove_like_count', array ('url' => $url));
    $this->output_json (array ('status' => true));
  }
}
