<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AboutPicture extends OaModel {

  static  $table_name = 'about_pictures';

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
    ModelUploader::bind ('file_name', 'AboutPictureUpload');
  }

  public function delete () {
    // $this->file_name->deleteOldFiles ();
    // parent::delete ();
    $this->is_enabled = 0;
    $this->save ();
  }
}
