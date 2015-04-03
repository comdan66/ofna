<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Picture_list extends Admin_controller {
  private $feature_name_1 = null;
  private $object_name_1  = null;

  public function __construct () {
    parent::__construct ();

    $this->feature_name_1 = '瀑布流照片';
    $this->object_name_1  = 'Picture';

  }

  public function index ($submenu_num = 0) {
    $object_name = $this->object_name_1;

    $this->set_per_page ($submenu_num);
    
    $sql = array ('order'  => 'id DESC, created_at DESC',
                  'limit'  => $this->get_list_limit (),
                  'offset' => ($this->get_per_page () / $this->get_list_limit ()) * $this->get_list_limit ());

    $data["id"]          = $this->append_search_condition ($sql, 'Number', 'id', trim ($this->input_post ('id')));
    $data["title"]       = $this->append_search_condition ($sql, 'String', 'title', trim ($this->input_post ('title')));
    $data["description"] = $this->append_search_condition ($sql, 'String', 'description', trim ($this->input_post ('description')));
    $data["user_id"]     = $this->append_search_condition ($sql, 'Number', 'user_id', trim ($this->input_post ('user_id')));
    $data["user_uid"]    = $this->append_search_condition ($sql, 'String', 'user_uid', trim ($this->input_post ('user_uid')));
    $data["user_name"]   = $this->append_search_condition ($sql, 'String', 'user_name', trim ($this->input_post ('user_name')));
    
    $data["objects"] = $object_name::find ('all', $sql);

    unset ($sql['order'], $sql['limit'], $sql['offset']);
    $data['total_rows'] = $total_rows = $object_name::count ($sql);

    $data['run_time'] = $this->get_run_time ();
    $data['pagination'] = $this->set_pagination_config ('total_rows', $total_rows)->init_pagination ();
    
    $data['search_url'] = base_url (array ('admin', $this->get_class (), $this->get_method ()));
    $data['delete_url'] = base_url (array ('admin', $this->get_class (), 'delete'));
    
    $data['has_append_condition'] = $this->get_has_append_condition ();
    $data['feature_name_1'] = $this->feature_name_1;

    $this->load_view ($data);
  }

  public function delete ($id) {
    $object_name = $this->object_name_1;

    if (verifyNumber ($id) && verifyObject ($object = $object_name::find ('one', array ('conditions' => array ('id = ?', $id))))) {
      if ($this->is_ajax (false)) {

        delay_request ('delay_jobs', 'delete_picture', array ('id' => $id));
   
        $this->output_json (array ('status' => true, 'title' => '成功', 'message' => '刪除成功!', 'action' => 'function(){window.location.assign ("' . base_url (array ('admin', $this->get_class (), 'index')) . '");}'));
      } else { 
        $this->load_view (array ('delete_url' => base_url (array ('admin', $this->get_class (), $this->get_method (), $id))));
      }
    } else { redirect (array ('admin', $this->get_class (), 'index')); }
  }
  public function message ($title, $message, $redirect) {
    if (verifyString ($title) && verifyString ($message) && verifyString ($redirect)) {
      $this->add_hidden ('title', 'title', $title)
           ->add_hidden ('message', 'message', $message)
           ->add_hidden ('redirect', 'redirect', $redirect)
           ->set_method ('message')
           ->load_view ();
    } else { redirect (array ('admin', $this->get_class (), 'index')); }
  }
}
