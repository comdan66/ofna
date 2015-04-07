<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main_tw_cell extends Cell_Controller {

  /* render_cell ('main_tw_cell', 'header', array ()); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_tw_cell', 'banners', array ()); */
  // public function _cache_banners () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banners () {
    $banners = Banner::find ('all');
    return $this->setUseJsList (true)
                ->setUseCssList (true)
                ->load_view (array ('banners' => $banners));
  }

  /* render_cell ('main_tw_cell', 'about', array ()); */
  // public function _cache_about () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function about () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_tw_cell', 'news', array ()); */
  // public function _cache_news () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function news () {
    $news = Neww::find ('all', array ('order' => 'id ASC', 'offset' => 0, 'limit' => 6));
    $title = identity ()->get_session ('is_en') ? 'title_en' : 'title_tw';
    $description = identity ()->get_session ('is_en') ? 'description_en' : 'description_tw';

    return $this->setUseCssList (true)
                ->load_view (array ('news' => $news, 'title' => $title, 'description' => $description));
  }

  /* render_cell ('main_tw_cell', 'product', array ()); */
  // public function _cache_product () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function product () {
    $tags = ProductTag::all (array ('order' => 'sort ASC'));
    $name = identity ()->get_session ('is_en') ? 'name_en' : 'name_tw';

    return $this->setUseJsList (true)
                ->setUseCssList (true)
                ->load_view (array ('tags' => $tags, 'name' => $name));
  }

  /* render_cell ('main_tw_cell', 'howtobuy', array ()); */
  // public function _cache_howtobuy () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function howtobuy () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_tw_cell', 'contact', array ()); */
  // public function _cache_contact () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function contact () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('main_tw_cell', 'footer', array ()); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->setUseCssList (true)
                ->load_view ();
  }
}