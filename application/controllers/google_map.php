<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Google_map extends Site_controller {
  public function __construct () {
    parent::__construct ();

  }

  public function index () {
    redirect (array ($this->get_class (), 'beigang_319'));
  }

  public function beigang_319 ($time = 'afternoon') {
    $this->set_title ('北港迎媽祖 - 三月十九 繞境地圖')
         ->add_meta ('og:title', '北港迎媽祖 - 三月十九 繞境地圖', 'property')
         ->add_meta ('og:description', '臺灣農曆三月期間，各地迎媽祖活動非常頻繁盛況非常， 而在北港這個古鎮中更能體會到此股熱誠，對於北港人這更是一場年度盛會...', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖 - 三月十九 繞境地圖', 'property')

         ->add_meta ('og:image', base_url (array ('resource', 'image', 'image2.png')), 'property')
         ->add_meta ('og:url', current_url (), 'property')
         ->add_meta ('description', '臺灣農曆三月期間，各地迎媽祖活動非常頻繁盛況非常， 而在北港這個古鎮中更能體會到此股熱誠，對於北港人這更是一場年度盛會...')
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|三月十九路關|三月十九GoogleMap')
         ;

    $this->load_view (null, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function beigang_320 ($time = 'afternoon') {
    $this->set_title ('北港迎媽祖 - 三月二十 繞境地圖')
         ->add_meta ('og:title', '北港迎媽祖 - 三月二十 繞境地圖', 'property')
         ->add_meta ('og:description', '臺灣農曆三月期間，各地迎媽祖活動非常頻繁盛況非常， 而在北港這個古鎮中更能體會到此股熱誠，對於北港人這更是一場年度盛會...', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖 - 三月二十 繞境地圖', 'property')

         ->add_meta ('og:image', base_url (array ('resource', 'image', 'image2.png')), 'property')
         ->add_meta ('og:url', current_url (), 'property')
         ->add_meta ('description', '臺灣農曆三月期間，各地迎媽祖活動非常頻繁盛況非常， 而在北港這個古鎮中更能體會到此股熱誠，對於北港人這更是一場年度盛會...')
         ->add_meta ('keywords', '北港迎媽祖|北港三月二十|北港藝閣|北港廟會|三月二十路關|三月二十GoogleMap')
         ;

    $this->load_view (null, false, config ('d4_config', 'static_page_cache_time'));
  }
}
