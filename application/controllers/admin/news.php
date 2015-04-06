<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class News extends Admin_controller {

  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _delete ($ids) {
    if ($ids)
      array_map (function ($new) {
        array_map (function ($pic) {
          $pic->file_name->cleanAllFiles ();
          $pic->delete ();
        }, $new->pics);

        NewBlock::delete_all (array ('conditions' => array ('new_id = ?', $new->id)));

        $new->delete ();
      }, Neww::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);
    redirect (array ('admin', $this->get_class ()), 'refresh');
  }

  public function index ($offset = 0) {
    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = array ();

    $limit = 10;
    $total = Neww::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $news = Neww::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('news' => $news, 'pagination' => $pagination));
  }
  public function add () {
    $this->load_view ();
  }
  public function create () {
    if (!$this->has_post ())
      redirect (array ('admin', $this->get_class (), 'add'));

    $date = ($date = trim ($this->input_post ('date'))) ? $date : date ('Y-m-d');
    $title_tw = ($title_tw = trim ($this->input_post ('title_tw'))) ? $title_tw : '';
    $title_en = ($title_en = trim ($this->input_post ('title_en'))) ? $title_en : '';
    $description_tw = ($description_tw = trim ($this->input_post ('description_tw'))) ? $description_tw : '';
    $description_en = ($description_en = trim ($this->input_post ('description_en'))) ? $description_en : '';

    $files = $this->input_post ('files[]', true, true);
    $blocks = $this->input_post ('blocks');

    if (!verifyCreateOrm ($new = neww::create (array ('date' => $date, 'title_tw' => $title_tw, 'title_en' => $title_en, 'description_tw' => $description_tw, 'description_en' => $description_en)))) {
      @$new->delete ();
      return $this->set_method ('add')->load_view (array ('message' => '新增失敗!'));
    }

    array_map (function ($file) use ($new) {
      if (!(verifyCreateOrm ($pic = NewPic::create (array ('new_id' => $new->id, 'file_name' => ''))) && $pic->file_name->put ($file)))
        @$pic->delete ();
    }, $files);

    if ($blocks)
      array_map (function ($block) use ($new) {
      if (!verifyCreateOrm ($block = NewBlock::create (array ('new_id' => $new->id, 'sort' => $block['sort'], 'title_tw' => $block['title_tw'], 'title_en' => $block['title_en'], 'content_tw' => $block['content_tw'], 'content_en' => $block['content_en']))))
        @$block->delete ();
      }, $blocks);

    identity ()->set_session ('_flash_message', '新增成功!', true);
    redirect (array ('admin', $this->get_class ()));
  }
  public function edit ($id = 0) {
    if (!($new = Neww::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    $this->load_view (array ('new' => $new));
  }
  public function update ($id = 0) {
    if (!($new = Neww::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if (!$this->has_post ())
      redirect (array ('admin', $this->get_class (), 'edit', $new->id));

    $date = ($date = trim ($this->input_post ('date'))) ? $date : date ('Y-m-d');
    $title_tw = ($title_tw = trim ($this->input_post ('title_tw'))) ? $title_tw : '';
    $title_en = ($title_en = trim ($this->input_post ('title_en'))) ? $title_en : '';
    $description_tw = ($description_tw = trim ($this->input_post ('description_tw'))) ? $description_tw : '';
    $description_en = ($description_en = trim ($this->input_post ('description_en'))) ? $description_en : '';

    $pic_ids = ($pic_ids = $this->input_post ('pic_ids')) ? $pic_ids : array ();
    $files = $this->input_post ('files[]', true, true);
    $blocks = $this->input_post ('blocks');


    if ($del_ids = array_diff (column_array ($new->pics, 'id'), $pic_ids))
      array_map (function ($pic) {
        $pic->file_name->cleanAllFiles ();
        $pic->delete ();
      }, NewPic::find ('all', array ('conditions' => array ('id IN (?) AND new_id = ?', $del_ids, $new->id))));

    array_map (function ($file) use ($new) {
      if (!(verifyCreateOrm ($pic = NewPic::create (array ('new_id' => $new->id, 'file_name' => ''))) && $pic->file_name->put ($file)))
        @$pic->delete ();
    }, $files);
    
    NewBlock::delete_all (array ('conditions' => array ('new_id = ?', $new->id)));

    if ($blocks)
      array_map (function ($block) use ($new) {
      if (!verifyCreateOrm ($block = NewBlock::create (array ('new_id' => $new->id, 'sort' => $block['sort'], 'title_tw' => $block['title_tw'], 'title_en' => $block['title_en'], 'content_tw' => $block['content_tw'], 'content_en' => $block['content_en']))))
        @$block->delete ();
      }, $blocks);

    $new->date = $date;
    $new->title_tw = $title_tw;
    $new->title_en = $title_en;
    $new->description_tw = $description_tw;
    $new->description_en = $description_en;
    $new->save ();

    identity ()->set_session ('_flash_message', '修改成功!', true);
    redirect (array ('admin', $this->get_class ()));
  }
}