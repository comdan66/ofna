 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class PictureUpload extends ModelUploader{
 
   public function getVarsions () {
    return array (
      '310xW' => array ('resize', 310, 310, 'width'),
      // // "origin" => array (''),
      // '100xW' => array ('resize', 100, 100, 'width'),
      // '500xW' => array ('resize', 500, 500, 'width'),
      '640xW' => array ('resize', 640, 640, 'width'),
      '' => array ('resize', 1024, 1024, 'width')
      );
   }
   public function getFileName () {
    return date ('Y_m_d_H_m_s');
   }
 }
