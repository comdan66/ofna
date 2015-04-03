<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class OA_controller extends CI_controller {
  private $view_paths = null;
  private $components = null;

  private $favicon = null;
  private $title  = null;
  private $class  = null;
  private $method = null;

  private $use_cache = null;
  private $cache_prefix = null;
  private $cache_options = null;

  private $d4_redirect_method = null;

  public function __construct ($view_paths) {
    parent::__construct ();

    $this->load->driver ('cache', array ('adapter' => 'apc', 'backup' => 'file'));

    $this->load->helper ('form');
    $this->load->helper ('url');
    $this->load->helper ('html');
    $this->load->helper ('file');
    $this->load->helper ('view');

    $this->load->helper ('type');
    $this->load->helper ('error');
    $this->load->helper ('path');
    $this->load->helper ('upload_file');
    $this->load->helper ('php_active');
    $this->load->helper ('request');
    $this->load->helper ('config');
    $this->load->helper ('image');

    $this->load->library ('fb');
    $this->load->library ('identity');
    $this->load->library ('OpenGraph');
    $this->load->library ('pagination');

    $this->set_class ($this->router->fetch_class ());
    $this->set_method ($this->router->fetch_method ());
    $this->set_use_cache (false);
    $this->set_cache_prefix ('_cache_');
    $this->set_cache_options (array ('cache_sec' => 300, 'cache_key' => $this->class . '_' . $this->method));
    $this->set_title ('');
    $this->set_favicon ('');
    $this->_initPaths ($view_paths);
    $this->_initComponents ('javascript', 'css', 'meta', 'hidden', 'visit_menu', 'sidebar', 'topbar', 'footer');

    $this->add_meta ('Content-type', 'text/html; charset=utf-8', 'http-equiv')
         ->add_meta ('fb:admins', '100000100541088', 'property')
         ->add_meta ('fb:app_id', '1482020658677319', 'property')
    ;
  }

  protected function add_footer ($title = null, $submenus = array ()) {
    if (!isset ($this->components['footer'][$key = verifyString ($title) ? $title : '']) || !verifyArray ($this->components['footer'][$key], null)) $this->components['footer'][$key] = array ();
    if (verifyArray ($submenus)) foreach ($submenus as $submenu) array_push ($this->components['footer'][$key], array ('name' => $submenu[0], 'src' => verifyString ($submenu[1]) ? $submenu[1] : (verifyArray ($submenu[1]) ? base_url ($submenu[1]): null)));
    return $this;
  }

  protected function add_navheader ($name, $path) {
    if (verifyString ($name) && (verifyArray($path) || verifyString($path))) array_push ($this->components['topbar']['header'], array ('name' => $name, 'url' => verifyArray ($path) ? base_url ($path) : $path));
    return $this;
  }

  protected function _utility_navitem ($items) {
    if (verifyArray ($items, null)) {
      $info = array_shift ($items);
      $dropdowns = array ();
      if (count ($items)) foreach ($items as $item) if (verifyArray ($utility_navitem = $this->_utility_navitem ($item))) array_push ($dropdowns, $utility_navitem);
      return array ('name' => $info['name'], 'title' => isset ($info['title']) ? $info['title'] : null, 'target' => isset ($info['target']) ? $info['target'] : null, 'url' => isset ($info['url']) ? (verifyString ($info['url'], null) ? ($info['url'] == '' ? /*'#'*/null : $info['url']) : (verifyArray ($info['url'], null) ? (!count ($info['url']) ? /*'#'*/null : base_url ($info['url'])): null) ) : null, 'dropdowns' => $dropdowns);
    } else { return null; }
  }

  protected function add_left_navitem ($info = null) {
    if (verifyArrayFormat ($info, array ('name')) && (($num_args = func_num_args ()) > 0)) {
      $items = array (); for ($i = 1; $i < $num_args; $i++) array_push ($items, func_get_arg ($i));
      
      if (count ($items)) array_unshift ($items, $info);
      else array_push ($items, $info);

      if (count ($items) && verifyArray ($utility_navitem = $this->_utility_navitem ($items))) {
        if (!isset ($this->components['topbar']['left'])) $this->components['topbar']['left'] = array ();
        array_push ($this->components['topbar']['left'], $utility_navitem);
      }
    }
    return $this;
  }

  protected function add_right_navitem ($info = null) {
    if (verifyArrayFormat ($info, array ('name')) && (($num_args = func_num_args ()) > 0)) {
      $items = array (); for ($i = 1; $i < $num_args; $i++) array_push ($items, func_get_arg ($i));
      
      if (count ($items)) array_unshift ($items, $info);
      else array_push ($items, $info);

      if (count ($items) && verifyArray ($utility_navitem = $this->_utility_navitem ($items))) {
        if (!isset ($this->components['topbar']['right'])) $this->components['topbar']['right'] = array ();
        array_unshift ($this->components['topbar']['right'], $utility_navitem);
      }
    }
    return $this;
  }

  protected function load_components () {
    $frame_data = array ();
    $params = array (); for ($i = 1; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++) array_push ($params, $param);
    if (!verifyArray ($params)) $params = array_keys ($this->components);
    if (count ($params)) foreach ($params as $param) $frame_data[$param] = $this->load->view ($this->view_paths['component'] . DIRECTORY_SEPARATOR . $param, array ($param . '_list' => $this->get_component ($param)), true);
    return $frame_data;
  }

  protected function load_content ($data = '', $return = false, $content_name = 'content') {
    $view_path = $this->view_paths['content'] . DIRECTORY_SEPARATOR . $this->get_class () . DIRECTORY_SEPARATOR . $this->get_method () . DIRECTORY_SEPARATOR . $content_name . EXT;
    if (!$return) $this->load->view ($view_path, $data, $return);
    else return $this->load->view ($view_path, $data, $return);
  }

  protected function load_view ($data = '', $return = false, $cache_time = 0, $cache_append_path = null, $content_name = 'content', $frame_name = 'frame', $public_name = 'public') {
    if (verifyString ($this->class) && verifyString ($this->method)) {
    
    $this->add_css ('application', 'views', $this->view_paths['frame'], 'frame' . '.css')
         ->add_javascript ('application', 'views', $this->view_paths['frame'], 'frame' . '.js')
         ->add_css ('application', 'views', $this->view_paths['public'], $public_name . '.css')
         ->add_javascript ('application', 'views', $this->view_paths['public'], $public_name . '.js')
         ->add_css ('application', 'views', $this->view_paths['content'], $this->get_class (), $this->get_method (), $content_name . '.css')
         ->add_javascript ('application', 'views', $this->view_paths['content'], $this->get_class (), $this->get_method (), $content_name . '.js');

      $frame_data = array ();
      $frame_data = array_merge ($frame_data, $this->load_components ());
      $frame_data['title']   = $this->title;
      $frame_data['favicon'] = $this->favicon;
      $frame_data['content'] = $this->load_content ($data, true, $content_name);

      if (!$return) {
        $this->load->view ($this->view_paths['frame'] . DIRECTORY_SEPARATOR . $frame_name, $frame_data, $return);
        if (verifyNumber ($cache_time, 1)) $this->output->cache ($cache_time, $cache_append_path);
      }
      else {
        return $this->load->view ($this->view_paths['frame'] . DIRECTORY_SEPARATOR . $frame_name, $frame_data, $return);
      }
    } else {
      showError ('The OA_Controller lack of necessary resources!!  Please confirm your program again.');
    }
  }

  protected function set_favicon ($favicon) { if (verifyString ($favicon)) $this->favicon = $favicon; return $this; }
  protected function get_favicon () { return $this->favicon; }
  protected function set_title ($title) { if (verifyString ($title)) $this->title = $title; return $this; }
  protected function get_title () { return $this->title; }
  public function set_class ($class) { if (verifyString ($class)) $this->class = strtolower ($class); return $this; }
  public function get_class () { return strtolower ($this->class); }
  public function set_method ($method) { if (verifyString ($method)) $this->method = strtolower ($method); return $this; }
  public function get_method () { return strtolower ($this->method); }

  protected function input_get ($index = null, $xss_clean = true) { return (verifyString ($index) && verifyBoolean ($xss_clean)) ? $this->input->get ($index, $xss_clean) : null; }
  protected function input_post ($index = null, $xss_clean = true, $is_files = false) { return (verifyString ($index) && verifyBoolean ($xss_clean) && verifyBoolean ($is_files)) ? ($is_files ? $this->_getPostFiles ($index) : $this->input->post ($index, $xss_clean)) : null; }

  protected function is_post () { return ($this->input->post () === false) || verifyArray ($_POST, 0, 0) ? false : true; }
  protected function is_ajax ($is_post = true) { return $this->input->is_ajax_request () && (!$is_post || ($is_post && $this->is_post ())) ? true : false; }
  
  protected function file_url ($fileName, $is_auto = true) { return $is_auto ? base_url (array_map (function ($f) { return trim ($f, '/'); }, verifyArray ($fileName) ? (array_unshift ($fileName, RESOURCE_FILE_REL_PATH) ? $fileName : array ()): array (RESOURCE_FILE_REL_PATH, $this->class, $fileName))) : (verifyArray ($fileName) ? base_url (array_map (function ($f) { return trim ($f, '/'); }, $fileName)) : $fileName); }

  public function set_use_cache ($use_cache) { if (verifyBoolean ($use_cache)) $this->use_cache = $use_cache; return $this; }
  public function get_use_cache () { return $this->use_cache; }

  public function get_d4_redirect_method () { return strtolower ($this->d4_redirect_method); }
  public function set_d4_redirect_method ($d4_redirect_method) { if (verifyString ($d4_redirect_method)) $this->d4_redirect_method = strtolower ($d4_redirect_method); return $this; }

  public function get_cache_prefix () { return $this->cache_prefix; }
  public function set_cache_prefix ($cache_prefix) { if (verifyString ($cache_prefix)) $this->cache_prefix = $cache_prefix; return $this; }

  public function get_cache_options () { return $this->cache_options; }
  public function set_cache_options ($cache_options) { if (verifyArrayFormat ($cache_options, array ('cache_sec', 'cache_key'))) $this->cache_options = $cache_options; return $this; }

  public function set_cache ($use_cache, $cache_prefix = '_cache_') {
    if (!verifyBoolean ($use_cache)) showError ("The 'use_cache' must be boolean variable! Please confirm your program again.");
    if (!verifyString ($cache_prefix)) showError ("The 'cache_prefix' must be string variable! Please confirm your program again.");
    
    $this->use_cache = $use_cache;
    $this->cache_prefix = $cache_prefix;
    return $this;
  }

  private function _getPostFiles ($index) {
    if (verifyString ($index)) {
      preg_match_all ('/^(?P<var>\w+)(\s?\[\s?\]\s?)$/', $index, $matches);
      $matches = count ($matches['var']) ? $matches['var'][0] : null;
      return (verifyString ($matches) && ($index == $matches)) ? get_upload_file ($index) : get_upload_file ($index, 'one');
    } else { return null; }
  }

  protected function get_component ($key) { return verifyArrayFormat ($this->components, array ($key)) ? $this->components[$key] : array (); }

  protected function add_sidebar ($title = null, $submenus = array ()) {
    if (!isset ($this->components['sidebar'][$key = verifyString ($title) ? $title : '']) || !verifyArray ($this->components['sidebar'][$key], null)) $this->components['sidebar'][$key] = array ();
    if (verifyArray ($submenus)) foreach ($submenus as $submenu) array_push ($this->components['sidebar'][$key], array ('name' => $submenu[0], 'src' => verifyString ($submenu[1]) ? $submenu[1] : (verifyArray ($submenu[1]) ? base_url ($submenu[1]): null)));
    return $this;
  }

  protected function add_visit_menu ($name, $src = null, $class = null) {
    if (verifyString ($name)) array_push ($this->components['visit_menu'], array ('name' => $name, 'src' => ((verifyArray ($src) && verifyArray (array_map ('utilityPath', $src)) && verifyString ($src = implode ('/', $src))) || verifyString ($src)) && (preg_match_all ("/^(https?:\/\/?)/", $src = utilityPath ($src), $matches) || verifyString ($src = base_url (array ($src = utilityPath ($src))))) ? $src : null, 'class' => verifyString ($class) ? $class : null));
    return $this;
  }

  protected function add_hidden ($name, $id, $value, $class = null) {
    if (verifyString ($name) && verifyString ($id) && verifyNotNull ($value)) array_push ($this->components['hidden'], array ('name' => $name, 'id' => $id, 'value' => $value, 'class' => verifyString ($class) ? $class : null));
    return $this;
  }

  protected function add_meta ($name, $content, $type = 'name', $newline = true) {
    if (verifyString ($name) && verifyString ($content) && verifyString ($type) && verifyBoolean ($newline)) {
      if (verifyArray ($this->components['meta'])) foreach ($this->components['meta'] as $i => $value) if ($value['name'] == $name) ($this->components['meta'][$i]['content'] = $content) && !($content = null);
      if ($content) array_push ($this->components['meta'], array ('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
    }
    return $this;
  }

  protected function add_javascript () {
    $src = array (); for ($i = 0; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++) array_push ($src, $param);
    if (verifyString ($src = implode ('/', $src))) array_push ($this->components['javascript'], array ('exist' => preg_match_all ("/^(https?:\/\/?)/", $src = utilityPath ($src), $matches) || (verifyString ($src = utilityPath ($src)) && verifyFileReadable (FCPATH . $src) && verifyString ($src = base_url (array ($src)))) ? true : false, 'src' => $src));
    return $this;
  }

  protected function add_css () {
    $src = array (); for ($i = 0; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++) array_push ($src, $param);
    if (verifyString ($src = implode ('/', $src))) array_push ($this->components['css'], array ('exist' => preg_match_all ("/^(https?:\/\/?)/", $src = utilityPath ($src), $matches) || (verifyString ($src = utilityPath ($src)) && verifyFileReadable (FCPATH . $src) && verifyString ($src = base_url (array ($src)))) ? true : false, 'src' => $src));
    return $this;
  }

  protected function clear_component () {
    $params = array (); for ($i = 0; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++) array_push ($params, $param);
    if (verifyArray ($params)) foreach ($params as $param) if (verifyItemInArray ($param, array_keys ($this->components))) $this->components[$param] = array ();
    return $this;
  }

  private function _initComponents () {
    $params = array ();
    for ($i = 0; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++)
      !verifyArray ($now_vars = array_keys (get_object_vars ($this))) || !verifyItemInArray ($param, $now_vars) ? array_push ($params, $param) : showError ('Component 變數名稱有重複 或與 物件內變數重複!');

    $this->components = array ();
    if (verifyArray ($params))
      foreach ($params as $param)
        if (verifyFileReadable (FCPATH . APPPATH . 'views' . DIRECTORY_SEPARATOR . $this->view_paths['component'] . DIRECTORY_SEPARATOR . $param . EXT)) $this->components[$param] = array ();
        else showError ('Component 檔案不存在 或 不可讀取! Path: ' . FCPATH . APPPATH . 'views' . DIRECTORY_SEPARATOR . $this->view_paths['component'] . DIRECTORY_SEPARATOR . $param . EXT);

    return $this->clear_component ();
  }

  private function _initPaths ($view_paths) {
    if (!verifyArrayFormat ($view_paths = array_map ('utilityPath', $view_paths), array ('frame', 'component', 'content', 'public'))) showError ('view 各項路徑陣列格式有誤!');
    array_walk ($view_paths, function ($key, $path) { if (!verifyFolderReadable ( FCPATH . APPPATH . 'views' . DIRECTORY_SEPARATOR . utilityPath ($path))) showError ('view 下的 ' . $key . ' 路徑有誤 或 不可讀取! Path: ' . FCPATH . APPPATH . 'view' . DIRECTORY_SEPARATOR . $path); });
    $this->view_paths = $view_paths;

    return $this;
  }

  protected function output_json ($data, $cache = 0, $path = null) {
    $this->output->set_content_type ('application/json')->set_output (json_encode (verifyArray ($data) ? $data : array ('status' => false, 'message' => 'Warning! No Output Json Data!!')))->cache ($cache, $path);
  }
  
  protected function delete_output_cache () {
    $params = array (); for ($i = 0; ($i < func_num_args ()) && verifyString ($param = func_get_arg ($i)); $i++) array_push ($params, $param);
    return $this->output->delete_cache (implode ('/', $params));
  }


  public function _remap ($method, $params) {
    if (!verifyString ($method) || !verifyArray ($params, null) || (strtolower ($method) != strtolower ($this->method))) 
      showError ("The Controller happen unknown error... Please confirm your program again.");

    if (!in_array (strtolower ($method), array_map ('strtolower', get_class_methods ($this)))) {
      if (verifyString ($d4_redirect_method = $this->get_d4_redirect_method ()) && in_array ($d4_redirect_method, array_map ('strtolower', get_class_methods ($this)))) {
        array_unshift ($params, $method); $method = $d4_redirect_method;
      } else { show_404 (); }
    }

    if (verifyBoolean ($this->use_cache, true) && verifyString ($this->cache_prefix) && verifyString ($cache_method = $this->cache_prefix . $method) && in_array (strtolower ($cache_method), array_map ('strtolower', get_class_methods ($this))) && verifyArrayFormat ($cache_options = array_merge ($this->cache_options, call_user_func_array (array ($this, $cache_method), $params)), array ('cache_sec', 'cache_key'))) {
      if (!($view = $this->cache->file->get ($cache_options['cache_key']))) {
        ob_start ();
        call_user_func_array (array ($this, $method), $params);
        $view = ob_get_contents ();
        ob_end_clean ();
        $res = $this->cache->file->save ($cache_options['cache_key'], $view, $cache_options['cache_sec']);
      }
      echo $view;
    } else {
      call_user_func_array (array ($this, $method), array_slice ($params, 0));
    }
  }

}

class Site_controller extends OA_controller {
  
  public function __construct ($view_paths = array ('frame' => 'frame/site', 'component' => 'component', 'content' => 'content/site', 'public' => 'public')) {
    parent::__construct ($view_paths);
    $this->init ();

  }
  protected function init () {
    return $this->initMeta ()->initJavascriptCss ()->initTopbar ()->initVisitSetting ()->initFooter ();
  }

  protected function initMeta () {
    return $this
         ->set_title ('北港迎媽祖')
         ->add_meta ('robots', 'index,follow')
         ->add_meta ('og:title', '北港迎媽祖', 'property')
         ->add_meta ('og:description', '北港迎媽祖', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖', 'property')

         ->add_meta ('og:image', base_url (array ('resource', 'image', 'image1.jpg')), 'property')
         ->add_meta ('og:locale', 'zh_TW', 'property')
         ->add_meta ('og:type', 'website', 'property')
         ->add_meta ('og:url', current_url (), 'property')
         ->add_meta ('description', '北港迎媽祖')
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會')
         ;
  }
  protected function initJavascriptCss () {
    return $this->add_css (RESOURCE_CSS_REL_PATH, 'bootstrap_v3.0.0/bootstrap.css')
                ->add_css (RESOURCE_CSS_REL_PATH, 'bootstrap_v3.0.0/bootstrap-glyphicons.min.css')
                ->add_css (RESOURCE_CSS_REL_PATH, 'icomoon_d20140412/icomoon.css')
                ->add_css (RESOURCE_CSS_REL_PATH, 'jquery-ui-1.10.3.custom/redmond/jquery-ui-1.10.3.custom.min.css')
                ->add_css (RESOURCE_CSS_REL_PATH, 'OA-ui_v1.3/OA-ui.css')
                
                ->add_javascript (RESOURCE_JS_REL_PATH, 'jquery_v1.10.2/jquery-1.10.2.min.js')
                ->add_javascript (RESOURCE_JS_REL_PATH, 'jquery-ui-1.10.3.custom/jquery-ui-1.10.3.custom.min.js')
                ->add_javascript (RESOURCE_JS_REL_PATH, 'OA-ui_v1.3/OA-ui.js')
                ->add_javascript (RESOURCE_JS_REL_PATH, 'bootstrap_v3.0.0/bootstrap.min.js')
                ->add_javascript (RESOURCE_JS_REL_PATH, 'imgLiquid_v0.9.944/imgLiquid-min.js')

                ->add_javascript (RESOURCE_JS_REL_PATH, 'jquery-timeago_v1.3.1/jquery.timeago.js')
                ->add_javascript (RESOURCE_JS_REL_PATH, 'jquery-timeago_v1.3.1/locales/jquery.timeago.zh-TW.js')


                ->add_css (RESOURCE_CSS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox.css')
                ->add_css (RESOURCE_CSS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox-buttons.css')
                ->add_css (RESOURCE_CSS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox-thumbs.css')
                ->add_javascript (RESOURCE_JS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox.js')
                ->add_javascript (RESOURCE_JS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox-buttons.js')
                ->add_javascript (RESOURCE_JS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox-thumbs.js')
                ->add_javascript (RESOURCE_JS_REL_PATH . 'fancyBox_v2.1.5/jquery.fancybox-media.js')
                ->add_javascript (RESOURCE_JS_REL_PATH . 'masonry_v3.1.2/masonry.pkgd.min.js')

                ->add_hidden ('create_like_count_url', 'create_like_count_url', base_url (array ('records', 'create_like_count')))
                ->add_hidden ('remove_like_count_url', 'remove_like_count_url', base_url (array ('records', 'remove_like_count')))
                ;

  }

  protected function initTopbar () {
    
    $this->add_left_navitem (array ('name' => '<span class="icon-home"></span> 網站首頁', 'title' => '網站首頁', 'url' => array ('main_index', 'about')));
    $this->add_left_navitem (array ('name' => null));
    $this->add_left_navitem (array ('name' => '<span class="icon-pictures4"></span> 大家來PO北港', 'title' => '快來上傳熱血的北港廟會吧！', 'url' => array ('pictures')));
    $this->add_left_navitem (array ('name' => null));
    $this->add_left_navitem (array ('name' => '<span class="icon-map5"></span> 三月十九 繞境地圖', 'title' => '三月十九 Google Map 版本！', 'url' => array ('google_map', 'beigang_319')));
    $this->add_left_navitem (array ('name' => null));
    $this->add_left_navitem (array ('name' => '<span class="icon-map5"></span> 三月二十 繞境地圖', 'title' => '三月二十 Google Map 版本！', 'url' => array ('google_map', 'beigang_320')));
    $this->add_left_navitem (array ('name' => null));
    $this->add_left_navitem (array ('name' => '<span class="icon-info-large-outline"></span> 使用說明', 'title' => '關於本網站使用說明以及相關介紹！', 'url' => array ('main_index', 'others')));
    $this->add_left_navitem (array ('name' => null));

    // $this->add_right_navitem (array ('name' => '<span class="icon-exit"></span>', 'title' => '', 'url' => array ('platform', 'sign_out')));
    $this->add_right_navitem (array ('name' => '<span class="icon-facebook22"></span>', 'title' => '使用 Facebook 來PO出北港！', 'url' => $this->fb->getLoginUrl (array ('redirect_uri' => base_url (array ('platform', 'oauth_sing_in', 'facebook'))))));
    $this->add_right_navitem (array ('name' => null));
    $this->add_right_navitem (array ('name' => '<span id="reciprocal" data-duration="' . (strtotime ('2014-04-18 00:00:00') - strtotime (date ('Y-m-d H:i:s'))) . '" data-format="歲次 甲午年 三月十九日 還有 %s" data-message="就是現在，北港廟會開始囉！"></span>', 'title' => '大家快一起來倒數吧！', 'url' => ''));
    
    return $this;
  }

  protected function initVisitSetting () {
    return $this;
  }
 
  protected function initFooter () {

    return $this->add_footer ('相關網站', array (
              array ('北港朝天宮 官網', 'http://www.matsu.org.tw/index2.aspx'),
              array ('台灣厝仔 - 雲林縣北港朝天宮媽祖遶境', 'http://www.old-taiwan.as2.net/'),
              array ('北港新站', 'http://www.peikang.idv.tw/'),
              array ('北港媽祖婆', 'http://589.com.tw/scout/beigangmazu/'),
              array ('北港鎮金垂髫文化發展協會', 'https://www.facebook.com/groups/golden.prince'),
              )
            )->add_footer ('文章參考', array (
              array ('北港朝天宮 Wiki', 'http://zh.wikipedia.org/wiki/北港朝天宮'),
              array ('北港朝天宮 官網', 'http://www.matsu.org.tw/index2.aspx'),
              array ('台灣厝仔 - 雲林縣北港朝天宮媽祖遶境', 'http://www.old-taiwan.as2.net/'),
              array ('鄭煌霖 - 臺灣三大炮之北港迎媽祖 報告文件', 'http://www.shs.edu.tw/works/essay/2011/03/2011032809444385.pdf'),
              array ('蕃薯藤 - 2013 北港媽祖活動', 'http://event6.yam.com/matsu/contest.php'),
              )
            )->add_footer ('Facebook 官方網站', array (
              array ('北港朝天宮', 'https://www.facebook.com/beigangmatsu'),
              array ('北港迓媽祖', 'https://www.facebook.com/pages/北港迓媽祖/115131071836739'),
              array ('北港媽祖婆', 'https://www.facebook.com/beigangmazu'),
              array ('北港遊客中心', 'https://www.facebook.com/PeikangVC'),
              )
            )->add_footer ('相簿參考', array (
              array ('Monkeyy Dai - Flickr', 'https://www.flickr.com/photos/lifegoseon/'),
              array ('OA - Flickr', 'https://www.flickr.com/photos/comdan66/'),
              array ('蕃薯藤 - 2013 北港媽祖活動', 'http://event6.yam.com/matsu/contest.php'),
              )
            )->add_footer ('藝陣社團', array (
              array ('北港朝天宮 虎爺會', 'https://www.facebook.com/groups/471539299532767'),
              array ('北港朝天宮 五媽 金豐隆轎班會', 'https://www.facebook.com/pages/北港-朝天宮-五媽-金豐隆轎班會/154094928015406'),
              array ('北港朝天宮 六媽 金順崇轎班會', 'https://www.facebook.com/groups/195171297221045/'),
              array ('北港朝天宮 金瑞昭 註生娘娘會', 'https://www.facebook.com/groups/463137277094624/'),
              array ('北港朝天宮 金垂髫 文化發展協會', 'https://www.facebook.com/groups/golden.prince/'),
              // array ('北港 金聲順開路鼓', 'https://www.facebook.com/groups/512822725471613/'),
              // array ('北港金合順', 'https://www.facebook.com/groups/167413863291043/'),
              )
            )
            ;
  }
}

class Upload_controller extends Site_controller {
  private $run_time_start = null;
  private $list_limit = null;
  private $per_page   = null;
  private $pagination_config = null;
  private $has_append_condition = null;

  public function __construct ($view_paths = array ('frame' => 'frame/site', 'component' => 'component', 'content' => 'content/site', 'public' => 'public')) {
    parent::__construct ($view_paths);

    $this->set_run_time_start ()
         ->set_has_append_condition (false)
         ->set_list_limit (10)
         ->set_per_page ($this->input_post ('per_page') ? $this->input_post ('per_page') : 0)
         ->set_pagination_config ('page_query_string', true)
         ->set_pagination_config ('query_string_segment', 'per_page')
         ->set_pagination_config ('num_links', 5)
         ->set_pagination_config ('per_page', $this->get_list_limit ())
         ->set_pagination_config ('base_url', base_url (array ($this->get_class (), $this->get_method ())))
         ->set_pagination_config ('first_link', '第一頁')
         ->set_pagination_config ('last_link', '最後頁')
         ->set_pagination_config ('prev_link', '上一頁')
         ->set_pagination_config ('next_link', '下一頁')
         ->set_pagination_config ('uri_segment', 3)
         ->set_pagination_config ('full_tag_open', '<ul class="pagination">')
         ->set_pagination_config ('full_tag_close', '</ul>')
         ->set_pagination_config ('first_tag_open', '<li>')
         ->set_pagination_config ('first_tag_close', '</li>')
         ->set_pagination_config ('prev_tag_open', '<li>')
         ->set_pagination_config ('prev_tag_close', '</li>')
         ->set_pagination_config ('num_tag_open', '<li>')
         ->set_pagination_config ('num_tag_close', '</li>')
         ->set_pagination_config ('cur_tag_open', '<li class="active"><a href="#">')
         ->set_pagination_config ('cur_tag_close', '<span class="sr-only">(current)</span></a></li>')
         ->set_pagination_config ('next_tag_open', '<li>')
         ->set_pagination_config ('next_tag_close', '</li>')
         ->set_pagination_config ('last_tag_open', '<li>')
         ->set_pagination_config ('last_tag_close', '</li>')
         ->set_pagination_config ('page_query_string', false);
  }
  protected function get_run_time () { return (microtime (true) - $this->run_time_start) < 1 ? ('耗時 : ' . (microtime (true) - $this->run_time_start) . '秒') : gmdate ("耗時 : H小時 i分鐘 s秒", microtime (true) - $this->run_time_start); }
  protected function get_list_limit () { return $this->list_limit; }
  protected function get_per_page () { return (((int)($this->per_page / $this->get_list_limit ())) * $this->get_list_limit ()); }
  protected function get_pagination_config () { return $this->pagination_config; }
  protected function get_has_append_condition () { return $this->has_append_condition; }
  protected function init_pagination () { $this->pagination->initialize ($this->get_pagination_config ()); return $this->pagination->create_links (); }

  protected function set_list_limit ($list_limit) { $this->list_limit = $list_limit; return $this; }
  protected function set_per_page ($per_page) { $this->per_page = $per_page; return $this; }
  protected function set_pagination_config ($key, $value) { $this->pagination_config[$key] = $value; return $this; }
  protected function set_has_append_condition ($value) { $this->has_append_condition = $value; return $this; }
  protected function set_run_time_start () { $this->run_time_start = microtime (true); return $this; }
  
  protected function append_condition ($sql, $conditions, $value) {
    $this->set_has_append_condition (true);

    if (!isset ($sql['conditions'])) { $sql['conditions'] = array (); }
    if (!isset ($sql['conditions'][0])) { $sql['conditions'][0] = ''; }
    $sql['conditions'][0] .= (verifyString ($sql['conditions'][0]) ? ' AND ' : '') . $conditions;
    for ($i = 2; $i < func_num_args (); $i++) { array_push ($sql['conditions'], func_get_arg ($i)); }
    return $sql;
  }


  protected function append_search_condition (&$sql, $type, $column_name, $value) {
    switch ($type) {
      case 'Number': case 'number':
        if (verifyNumber ($value)) { $sql = $this->append_condition ($sql, $column_name . ' = ?', $value); }
        else { $value = null; }
        break;

      case 'String': case 'string':
        if (verifyString ($value)) { $sql = $this->append_condition ($sql, $column_name . ' like CONCAT("%", ? ,"%")', $value); }
        else { $value = null; }
        break;
      
      default:
        $value = null;
        break;
    }
    return $value;
  }
}

class Admin_controller extends Upload_controller {

  public function __construct ($view_paths = array ('frame' => 'frame/admin', 'component' => 'component', 'content' => 'content/admin', 'public' => 'public')) {
    parent::__construct ($view_paths);

    if (!$this->identity->get_identity ('admins')) { redirect (array ('main_index')); }

    $this->add_meta ('robots', 'noindex,nofollow')
         ->add_sidebar ('後台功能', array (
              array ('照片列表', array ('admin', 'picture_list')),
              array ('讚數列表', array ('admin', 'like_count_list')),
              array ('首頁簡介', array ('admin', 'abouts')),
              array ('快取清除', array ('admin', 'clean_caches')),
              )
         )
         ->set_list_limit (10)
         ->set_pagination_config ('uri_segment', 4)
         ->set_pagination_config ('base_url', base_url (array ('admin', $this->get_class (), $this->get_method ())))
         ;
  }
}

class Error_controller extends Site_controller {

  public function __construct ($view_paths = array ('frame' => 'frame/site', 'component' => 'component', 'content' => 'content/site', 'public' => 'public')) {
    parent::__construct ($view_paths);
  }
}

class Delay_controller extends OA_controller {
  public function __construct ($view_paths = array ('frame' => 'frame/site', 'component' => 'component', 'content' => 'content/site', 'public' => 'public')) {
    parent::__construct ($view_paths);
    if ($this->_initAuthenticate ()) showError ('驗證錯誤！！');
  }

  private function _initAuthenticate () {
    return (config ('d4_config', 'delay_request', 'method') == 'http') && (md5 (config ('d4_config', 'delay_request', 'request_code_value')) == $this->input_post (config ('d4_config', 'delay_request', 'request_code_key'))) ? true : false;
  }
}
