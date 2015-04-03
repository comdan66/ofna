 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class AboutPictureUpload extends ModelUploader{
 
   public function getVarsions () {
    return array (
      '' => array ('adaptiveResizeQuadrant', 640, 427, 'C'),
      // "origin" => array (''),
      '100xW' => array ('resize', 100, 100, 'width'),
      '500xW' => array ('resize', 500, 500, 'width'),
      '1400xW' => array ('resize', 1400, 1400, 'width')
      );
   }
   public function getFileName () {
    return date ('Y_m_d_H_m_s');
   }
 }
