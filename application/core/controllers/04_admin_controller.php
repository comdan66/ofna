<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Admin_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    $this->load->helper ('identity');

    $this
         ->set_componemt_path ('component', 'admin')
         ->set_frame_path ('frame', 'admin')
         ->set_content_path ('content', 'admin')
         ->set_public_path ('public')

         ->set_title ("OA's CI")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ->add_hidden (array ('id' => '_flash_message', 'value' => identity ()->get_session ('_flash_message', true)))
         ;
  }

  private function _add_meta () {
    return $this;
  }

  private function _add_css () {
    return $this
            ->add_css ('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700', false)
            ->add_css (base_url ('resource', 'css', 'admin', 'style.css'))
            ->add_css (base_url ('resource', 'css', 'admin', 'form.css'))
            ->add_css (base_url ('resource', 'css', 'admin', 'DropMenu05.css'))
            ->add_css (base_url ('resource', 'css', 'jquery.jgrowl_v1.3.0', 'jquery.jgrowl.css'))
            ;
  }

  private function _add_js () {
    return $this->add_js (base_url ('resource', 'javascript', 'jquery_v1.10.2', 'jquery-1.10.2.min.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery-rails_d2015_03_09', 'jquery_ujs.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery-ui-1.10.3.custom', 'jquery-ui-1.10.3.custom.min.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery.jgrowl_v1.3.0', 'jquery.jgrowl.js'))
                ->add_js (base_url ('resource', 'javascript', 'underscore_v1.7.0', 'underscore-min.js'), false)
                ;
  }
}