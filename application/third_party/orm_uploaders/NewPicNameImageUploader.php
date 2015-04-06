<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class NewPicNameImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '100w' => array ('resize', 100, 100, 'width'),
        '400w' => array ('resize', 400, 400, 'width'),
        '221x155c' => array ('adaptiveResizeQuadrant', 221, 155, 'c')
      );
  }
}