<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Main_index extends Site_controller {
  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    redirect (array ('main_index', 'about'));
  }

  public function about () {
  	$this->set_title ('北港迎媽祖 - 北港、遶境簡介')
         ->add_meta ('og:title', '2014年 北港迎媽祖 - 北港、遶境簡介', 'property')
         ->add_meta ('og:description', '三月瘋媽祖如果你想知道這是什麼感覺，那你就來看看北港媽祖出巡繞境就知道了！ 因為北港人對媽祖的熱情，真的真的會讓你永生難忘...', 'property')
         ->add_meta ('og:site_name', '2014年 北港迎媽祖 - 北港、遶境簡介', 'property')
         ->add_meta ('description', '三月瘋媽祖如果你想知道這是什麼感覺，那你就來看看北港媽祖出巡繞境就知道了！ 因為北港人對媽祖的熱情，真的真的會讓你永生難忘...')
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|北港、遶境簡介|北港簡介')
         ;

  	$abouts = About::find ('all', array ('order' => 'sort DESC, id DESC'));
  	$this->load_view (array ('abouts' => $abouts, 'updated_at' => '2014-04-11 10:14:27'), false, config ('d4_config', 'static_page_cache_time'));
  }

  public function others () {
    $this->set_title ('北港迎媽祖 - 網站 使用說明')
         ->add_meta ('og:title', '北港迎媽祖 - 網站 使用說明', 'property')
         ->add_meta ('og:description', '這是個熱愛北港廟會活動的非營利網站，希望能為地方古蹟、習俗活動帶來一點貢獻， 更希望大家參與北港廟會活動的同時，能更加的融入北港當地的文化...', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖 - 網站 使用說明', 'property')
         ->add_meta ('description', '這是個熱愛北港廟會活動的非營利網站，希望能為地方古蹟、習俗活動帶來一點貢獻， 更希望大家參與北港廟會活動的同時，能更加的融入北港當地的文化...')
         ;

    $this->load_view (null, false, config ('d4_config', 'static_page_cache_time'));
  }
}
