<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Platform extends Site_controller {
  public function __construct () {
    parent::__construct ();
  }

  public function oauth_sing_in ($platform, $redirect = null) {
    switch ($platform) {
      default: redirect (array ('error', 'oauth_incomplete_params')); break;
      case 'facebook':
        if (verifyString ($uid = $this->fb->getUser ()) && verifyString ($token = $this->fb->getAccessToken ())) {
          if (verifyObject ($user = User::find ('one', array ('conditions' => array ('uid = ?', $uid = $this->fb->getUser ()))))) {
            $this->identity->set_session ('user_id', $user->id);
            $this->identity->set_session ('fb_uid', $user->uid);
            $this->identity->set_session ('fb_name', $user->name);
            $this->identity->set_session ('fb_email', $user->email);

            redirect (verifyString ($redirect) ? $redirect : array ('pictures', 'upload_picture'));
          } else {
            if (verifyArray ($fb_user = $this->fb->fql ('SELECT email, name FROM user WHERE uid=' . $uid)) && verifyArray ($fb_user = array_shift ($fb_user))) {
              if (verifyCreateObject ($user = User::create (array ('uid' => $uid, 'name' => $fb_user['name'], 'email' => $fb_user['email'])))) {
                $this->identity->set_session ('user_id', $user->id);
                $this->identity->set_session ('fb_uid', $user->uid);
                $this->identity->set_session ('fb_name', $user->name);
                $this->identity->set_session ('fb_email', $user->email);

                redirect (verifyString ($redirect) ? $redirect : array ('pictures', 'upload_picture'));
              } else { redirect (array ('error', 'oauth_facebook_incomplete_vars')); }
            } else { redirect (array ('error', 'oauth_facebook_incomplete_vars')); }
          }
        } else { redirect (array ('error', 'oauth_facebook_incomplete_vars')); }
        break;
    }
  }

  public function sign_out () {
    $this->identity->set_identity ('sign_out');
    redirect (array ('main_index'));
  }
}
