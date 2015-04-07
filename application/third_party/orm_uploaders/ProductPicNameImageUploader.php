<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class ProductPicNameImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '100w' => array ('resize', 100, 100, 'width'),
        '431w' => array ('resize', 431, 431, 'width'),
        '240x175c' => array ('adaptiveResizeQuadrant', 240, 175, 'c')
      );
  }
}