<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Picture extends OaModel {

  static  $table_name = 'pictures';

  static $belongs_to = array (
    array ('user', 'class_name' => 'User'),
  );

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
    ModelUploader::bind ('file_name', 'PictureUpload');
  }

  public function delete () {
    // $this->file_name->deleteOldFiles ();
    $this->is_enabled = 0;
    $this->save ();
  }
}
