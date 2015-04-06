<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Products extends Admin_controller {

  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  public function del_tag () {
    if (!$this->is_ajax ())
      show_error ("It's not Ajax request!<br/>Please confirm your program again.");
    
    $id = $this->input_post ('id');

    if (!($tag = ProductTag::find ('one', array ('conditions' => array ('id = ?', $id)))))
      return $this->output_json (array ('status' => false));

    ProductTagMap::delete_all (array ('conditions' => array ('product_tag_id = ?', $tag->id))); 
    $tag->delete ();

    return $this->output_json (array ('status' => true));
  }

  public function tags () {
    if ($this->has_post ()) {

      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (ProductTag::create (array ('name' => $name, 'sort' => ProductTag::count () + 1))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        if (($ids = array_diff (column_array (ProductTag::find ('all', array ('select' => 'id')), 'id'), array_map (function ($tag) { return $tag['id']; }, $tags))))
          array_map (function ($tag) {
            ProductTagMap::delete_all (array ('conditions' => array ('product_tag_id = ?', $tag->id)));
            $tag->delete ();
          }, ProductTag::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            ProductTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
    }

    $tags = ProductTag::find ('all', array ('order' => 'sort ASC, id DESC'));
    $this->add_hidden (array ('id' => 'get_del_tag_url', 'value' => base_url (array ('admin', $this->get_class (), 'del_tag'))))
         ->load_view (array ('tags' => $tags));
  }

  public function index ($offset = 0) {
    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = array ();

    $limit = 10;
    $total = Product::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $products = Product::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('products' => $products, 'pagination' => $pagination));
  }
  public function add () {
    $this->load_view ();
  }
  public function create () {
    if (!$this->has_post ())
      redirect (array ('admin', $this->get_class (), 'add'));

    $title_tw = ($title_tw = trim ($this->input_post ('title_tw'))) ? $title_tw : '';
    $title_en = ($title_en = trim ($this->input_post ('title_en'))) ? $title_en : '';
    $description_tw = ($description_tw = trim ($this->input_post ('description_tw'))) ? $description_tw : '';
    $description_en = ($description_en = trim ($this->input_post ('description_en'))) ? $description_en : '';

    $files = $this->input_post ('files[]', true, true);
    $prices = $this->input_post ('prices');
    $blocks = $this->input_post ('blocks');
    $tag_ids = $this->input_post ('tag_ids');

    if (!verifyCreateOrm ($product = Product::create (array ('title_tw' => $title_tw, 'title_en' => $title_en, 'description_tw' => $description_tw, 'description_en' => $description_en)))) {
      @$product->delete ();
      return $this->set_method ('add')->load_view (array ('message' => '新增失敗!'));
    }

    array_map (function ($file) use ($product) {
      if (!(verifyCreateOrm ($pic = ProductPic::create (array ('product_id' => $product->id, 'name' => ''))) && $pic->name->put ($file)))
        @$pic->delete ();
    }, $files);

    if ($prices)
      array_map (function ($price) use ($product) {
      if (!verifyCreateOrm ($price = ProductPrice::create (array ('product_id' => $product->id, 'value_tw' => $price['value_tw'], 'value_en' => $price['value_en']))))
        @$price->delete ();
      }, $prices);

    if ($blocks)
      array_map (function ($block) use ($product) {
      if (!verifyCreateOrm ($block = ProductBlock::create (array ('product_id' => $product->id, 'sort' => $block['sort'], 'title_tw' => $block['title_tw'], 'title_en' => $block['title_en'], 'content_tw' => $block['content_tw'], 'content_en' => $block['content_en']))))
        @$block->delete ();
      }, $blocks);

    if ($tag_ids)
      array_map (function ($tag) use ($product) {
        ProductTagMap::create (array ('product_id' => $product->id, 'product_tag_id' => $tag->id));
      }, ProductTag::find ('all', array ('select' => 'id', 'conditions' => array ('id IN (?)', $tag_ids))));

    identity ()->set_session ('_flash_message', '新增成功!', true);
    redirect (array ('admin', $this->get_class ()));
  }
  public function edit ($id = 0) {
    if (!($product = Product::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    $this->load_view (array ('product' => $product));
  }
  public function update ($id = 0) {
    if (!($product = Product::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if (!$this->has_post ())
      redirect (array ('admin', $this->get_class (), 'edit', $product->id));

    $title_tw = ($title_tw = trim ($this->input_post ('title_tw'))) ? $title_tw : '';
    $title_en = ($title_en = trim ($this->input_post ('title_en'))) ? $title_en : '';
    $description_tw = ($description_tw = trim ($this->input_post ('description_tw'))) ? $description_tw : '';
    $description_en = ($description_en = trim ($this->input_post ('description_en'))) ? $description_en : '';

    $pic_ids = ($pic_ids = $this->input_post ('pic_ids')) ? $pic_ids : array ();
    $files = $this->input_post ('files[]', true, true);
    $prices = $this->input_post ('prices');
    $blocks = $this->input_post ('blocks');
    $tag_ids = $this->input_post ('tag_ids');

    if ($del_ids = array_diff (column_array ($product->pics, 'id'), $pic_ids))
      array_map (function ($pic) {
        $pic->name->cleanAllFiles ();
        $pic->delete ();
      }, ProductPic::find ('all', array ('conditions' => array ('id IN (?) AND product_id = ?', $del_ids, $product->id))));

    array_map (function ($file) use ($product) {
      if (!(verifyCreateOrm ($pic = ProductPic::create (array ('product_id' => $product->id, 'name' => ''))) && $pic->name->put ($file)))
        @$pic->delete ();
    }, $files);
    
    ProductBlock::delete_all (array ('conditions' => array ('product_id = ?', $product->id)));

    if ($blocks)
      array_map (function ($block) use ($product) {
      if (!verifyCreateOrm ($block = ProductBlock::create (array ('product_id' => $product->id, 'sort' => $block['sort'], 'title_tw' => $block['title_tw'], 'title_en' => $block['title_en'], 'content_tw' => $block['content_tw'], 'content_en' => $block['content_en']))))
        @$block->delete ();
      }, $blocks);
    
    ProductPrice::delete_all (array ('conditions' => array ('product_id = ?', $product->id)));

    if ($prices)
      array_map (function ($price) use ($product) {
      if (!verifyCreateOrm ($price = ProductPrice::create (array ('product_id' => $product->id, 'value_tw' => $price['value_tw'], 'value_en' => $price['value_en']))))
        @$price->delete ();
      }, $prices);

    ProductTagMap::delete_all (array ('conditions' => array ('product_id = ?', $product->id)));

    if ($tag_ids)
      array_map (function ($tag) use ($product) {
        ProductTagMap::create (array ('product_id' => $product->id, 'product_tag_id' => $tag->id));
      }, ProductTag::find ('all', array ('select' => 'id', 'conditions' => array ('id IN (?)', $tag_ids))));

    $product->title_tw = $title_tw;
    $product->title_en = $title_en;
    $product->description_tw = $description_tw;
    $product->description_en = $description_en;
    $product->save ();

    identity ()->set_session ('_flash_message', '修改成功!', true);
    redirect (array ('admin', $this->get_class ()));
  }
}
