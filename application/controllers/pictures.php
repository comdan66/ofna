<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Pictures extends Upload_controller {
  private $limit = null;

  public function __construct () {
    parent::__construct ();
    $this->limit = 20;
  }

  public function index () {
    $this->set_title ('北港迎媽祖 - 大家來PO北港')
         ->add_meta ('og:title', '北港迎媽祖 - 大家來PO北港', 'property')
         ->add_meta ('og:description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖 - 大家來PO北港', 'property')

         ->add_meta ('og:image', base_url (array ('resource', 'image', 'image3.jpg')), 'property')
         ->add_meta ('og:url', current_url (), 'property')
         ->add_meta ('description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！')
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|大家來PO北港')

         ->add_hidden ('get_pictures_url', 'get_pictures_url', base_url (array ($this->get_class (), 'get_pictures')))
         ->load_view (array ('url' => $this->identity->get_identity ('sign_in') ? base_url (array ('pictures', 'upload_picture')) : $this->fb->getLoginUrl (array ('redirect_uri' => base_url (array ('platform', 'oauth_sing_in', 'facebook'))))), false, config ('d4_config', 'static_page_cache_time'));
  }


  public function upload_picture () {
    if (!config ('d4_config', 'upload_picture', 'is_enable')) redirect (array ($this->get_class (), 'disable'));
    if (!$this->identity->get_identity ('sign_in')) redirect ($this->fb->getLoginUrl (array ('redirect_uri' => base_url (array ('platform', 'oauth_sing_in', 'facebook')))));
    $update_time = $this->identity->get_session ('update_time') ? $this->identity->get_session ('update_time') : 0;

    $enable = (time () - $update_time) > config ('d4_config', 'upload_picture', 'duration') ? true : false;

    if ($this->is_post ()) {
      $title = $this->input_post ('title');
      $description = $this->input_post ('description');
      $picture = $this->input_post ('picture', true, true);
      $sync_facebook = $this->input_post ('sync_facebook');

      if (verifyString ($title) && (mb_strlen ($title, "utf-8") <= config ('d4_config', 'upload_picture', 'title_max_length'))) {
        if (verifyString ($description) && (mb_strlen ($description, "utf-8") <= config ('d4_config', 'upload_picture', 'description_max_length'))) {
          if (verifyUploadFormat ($picture)) {
            if (verifyItemInArray ($picture['type'], config ('d4_config', 'upload_picture', 'format_2s'))) {
              if ($picture['size'] < config ('d4_config', 'upload_picture', 'max_size')) {
                $object = Picture::create (array ('user_id' => $this->identity->get_session ('user_id'), 'user_uid' => $this->identity->get_session ('fb_uid'), 'user_name' => $this->identity->get_session ('fb_name'), 'file_name' => '', 'proportion' => 0, 'title' => $title, 'description' => $description, 'is_sync' => $sync_facebook == 'on' ? 1 : 0));

                $object->file_name->put ($picture);
                $dimension = $object->file_name->getDimension ();
                $object->proportion = ($dimension['width'] / $dimension['height']);
                $object->save ();

                if (verifyString ($sync_facebook) && ($sync_facebook == 'on')) {
                  try {
                    if ($this->fb->getUser ()) {
                      $res = $this->fb->api ('/me/photos', 'POST', array(
                        'url' => $object->file_name->url (),
                        'message' => $description . " \r\n #北港朝天宮 " . base_url (array ('pictures', 'id',  $object->id)),
                      ));
                    }
                  } catch(FacebookApiException $e) { } 
                }

                delay_request ('delay_jobs', 'clean_pictures');

                $this->identity->set_session ('update_time', time ());
                $this->set_method ('message')->_message ('訊息', '新增成功');

              } else { $this->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'message' => '照片大小不符合規定!', 'title' => $title, 'description' => $description, 'sync_facebook' => $sync_facebook == 'on', 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
            } else { $this->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'message' => '照片格式不符合規定!', 'title' => $title, 'description' => $description, 'sync_facebook' => $sync_facebook == 'on', 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
          } else { $this->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'message' => '請選擇照片!', 'title' => $title, 'description' => $description, 'sync_facebook' => $sync_facebook == 'on', 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
        } else { $this->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'message' => '請輸入少於 ' . config ('d4_config', 'upload_picture', 'description_max_length') . '個字的照片敘述!', 'title' => $title, 'description' => $description, 'sync_facebook' => $sync_facebook == 'on', 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
      } else { $this->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'message' => '請輸入少於 ' . config ('d4_config', 'upload_picture', 'title_max_length') . '個字的照片標題!', 'title' => $title, 'description' => $description, 'sync_facebook' => $sync_facebook == 'on', 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
    } else {
      $this->set_title ('北港迎媽祖 - 大家來PO北港')
           ->add_meta ('og:title', '北港迎媽祖 - 大家來PO北港', 'property')
           ->add_meta ('og:description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！', 'property')
           ->add_meta ('og:site_name', '北港迎媽祖 - 大家來PO北港', 'property')

           ->add_meta ('og:image', base_url (array ('resource', 'image', 'image3.jpg')), 'property')
           ->add_meta ('description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！')
           ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|大家來PO北港')

           ->add_hidden ('update_time', 'update_time', $update_time)->load_view (array ('that' => $this, 'enable' => $enable, 'enable' => $enable, 'message' => '', 'title' => '', 'description' => '', 'sync_facebook' => true, 'upload_picture_url' => base_url (array ($this->get_class (), $this->get_method ())))); }
  }

  public function disable () {
    $this->set_title ('北港迎媽祖 - 大家來PO北港')
         ->add_meta ('og:title', '北港迎媽祖 - 大家來PO北港', 'property')
         ->add_meta ('og:description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！', 'property')
         ->add_meta ('og:site_name', '北港迎媽祖 - 大家來PO北港', 'property')

         ->add_meta ('og:image', base_url (array ('resource', 'image', 'image3.jpg')), 'property')
         ->add_meta ('description', '希望藉由上傳照片的功能，讓廟會使人感動的美感分享給同好！想為北港媽祖三月十九繞境活動作宣傳，希望可以讓台灣所有人看得到北港。希望熱愛北港的朋友們可以一起參與，北港這個小鎮是有著很多的百年藝陣、內涵傳統、宗教信仰... 等，希望這小鎮特色的是能被記錄與看見， 無論是建議或推薦文章還是拍照記錄的笨港照片，提供讓網站更加豐富！')
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|大家來PO北港')

         ->load_view (null, false, config ('d4_config', 'static_page_cache_time'));
  }

  public function id ($id = 0) {
    if (verifyObject ($picture = Picture::find ('one', array ('conditions' => array ('id = ?', $id))))) {
      
    $this->set_title ('北港迎媽祖' . ' - 來自' . $picture->user_name . '的上傳照片!')
         ->add_meta ('og:title', $picture->user_name . '上傳照片到 北港迎媽祖', 'property')
         ->add_meta ('og:description', $picture->user_name . '在 北港迎媽祖PO一張照片 : ' . $picture->title . ', ' . $picture->description, 'property')
         ->add_meta ('og:site_name', '北港迎媽祖' . ' - 來自' . $picture->user_name . '的上傳照片!', 'property')
         ->add_meta ('og:image', $picture->file_name->url ('640xW'), 'property')
         ->add_meta ('description', $picture->user_name . ' 在 北港迎媽祖PO一張照片 : ' . $picture->title . ', ' . $picture->description)
         ->add_meta ('keywords', '北港迎媽祖|北港三月十九|北港藝閣|北港廟會|' . $picture->title . '|' . $picture->description)
         ;

      $this->add_hidden ('delete_url', 'delete_url', $this->identity->get_identity ('admins') ? base_url (array ($this->get_class (), 'delete')) : '')
           ->load_view (array ('picture' => $picture, 'is_admins' => $this->identity->get_identity ('admins')), false, config ('d4_config', 'static_page_cache_time'));
    } else { redirect (array ('pictures')); }
  }

  public function get_pictures () {
    if (!$this->is_ajax ())  redirect (array ('error', 'not_ajax'));
    $next_id = $this->input_post ('next_id');

    $conditions = array ();
    if (verifyNumber ($next_id, 1)) append_condition ($conditions, 'AND', '(id <= ?)', $next_id);

    $pictures = Picture::find ('all', array ('limit' => $this->limit + 1, 'order' => 'id DESC, created_at DESC', 'conditions' => $conditions));

    $contents = array ();
    if (verifyArray ($pictures)) foreach ($pictures as $i => $picture) if ($i < $this->limit) array_push ($contents, $this->load_content (array ('picture' => $picture), true));

    $next_id = verifyArray ($pictures) && count ($pictures) == ($this->limit + 1) ? $pictures[$this->limit]->id : -1;

    $this->output_json (array ('status' => true, 'contents' => $contents, 'next_id' => $next_id), config ('d4_config', 'dynamic_page_cache_time'));
  }

  private function _message ($title = null, $message = null) {
    if (verifyString ($title) && verifyString ($message)) {

      $this->add_hidden ('title', 'title', urldecode ($title))
           ->add_hidden ('message', 'message', urldecode ($message))
           ->add_hidden ('redirect', 'redirect', base_url (array ($this->get_class ())))
           ->load_view ();
    } else { redirect (array ($this->get_class (), 'pictures')); }
  }

  public function delete () {
    if (!$this->is_ajax () || !$this->identity->get_identity ('admins')) redirect (array ('error', 'not_ajax'));
    
    $id = $this->input_post ('id');

    delay_request ('delay_jobs', 'delete_picture', array ('id' => $id));
    $this->output_json (array ('status' => true, 'title' => '成功', 'message' => '刪除成功!', 'action' => 'function(){ $(this).OA_Dialog ("close"); window.location.assign ("' . base_url (array ($this->get_class (), 'pictures')) . '"); }'));
  }
}
