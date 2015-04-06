<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main_cell extends Cell_Controller {

  /* render_cell ('main_cell', 'header', array ()); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'banners', array ()); */
  // public function _cache_banners () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banners () {
    return $this->setUseJsList (true)
                ->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'about', array ()); */
  // public function _cache_about () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function about () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'news', array ()); */
  // public function _cache_news () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function news () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'product', array ()); */
  // public function _cache_product () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function product () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'howtobuy', array ()); */
  // public function _cache_howtobuy () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function howtobuy () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'contact', array ()); */
  // public function _cache_contact () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function contact () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_cell', 'footer', array ()); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->setUseCssList (true)
                ->load_view ();
  }
}