<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class BannerNameImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '80x80c' => array ('adaptiveResizeQuadrant',80, 80, 'c'),
        '1200x800c' => array ('adaptiveResizeQuadrant',1200, 800, 'c'),
      );
  }
}