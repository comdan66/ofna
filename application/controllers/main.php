<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $cell_class = identity ()->get_session ('is_en') ? 'main_en_cell' : 'main_tw_cell';
    $this->add_hidden (array ('id' => 'get_products_url', 'value' => base_url (array ($this->get_class (), 'get_products'))))
         ->load_view (array ('cell_class' => $cell_class));
  }

  public function get_products () {
    if (!$this->is_ajax ())
      show_error ("It's not Ajax request!<br/>Please confirm your program again.");

    $id = $this->input_post ('id');
    $page = $this->input_post ('page');
    $limit = 12;

    if (!($tag = ProductTag::find ('one', array ('conditions' => array ('id = ?', $id)))))
      return $this->output_json (array ('status' => false));

    if (!($product_ids = column_array (ProductTagMap::find ('all', array ('select' => 'product_id', 'order' => 'product_id DESC', 'offset' => $page * $limit, 'limit' => $limit, 'conditions' => array ('product_tag_id = ?', $tag->id))), 'product_id')))
      return $this->output_json (array ('status' => false));
    
    $products = Product::find ('all', array ('order' => 'id DESC', 'conditions' => array ('id IN (?)', $product_ids)));
    $page_count = ceil (ProductTagMap::count (array ('conditions' => array ('product_tag_id = ?', $tag->id))) / $limit);

    return $this->output_json (array ('status' => true, 'page_count' => $page_count, 'products' => array_map (function ($product) {
      $title = identity ()->get_session ('is_en') ? 'title_en' : 'title_tw';
      $description = identity ()->get_session ('is_en') ? 'description_en' : 'description_tw';

      return array (
        'id' => $product->id,
        'title' => $product->$title,
        'description' => $product->$description,
        'pics' => array_map (function ($pic) {return array ('id' => $pic->id, 'url' => array ('c240x175' => $pic->name->url ('240x175c'), 'w431' => $pic->name->url ('431w')));}, $product->pics),
        'prices' => array_map (function ($price) {$value = identity ()->get_session ('is_en') ? 'value_en' : 'value_tw'; return array ('id' => $price->id, 'value' => $price->$value);}, $product->prices),
        'blocks' => array_map (function ($block) {$title = identity ()->get_session ('is_en') ? 'title_en' : 'title_tw'; $content = identity ()->get_session ('is_en') ? 'content_en' : 'content_tw'; return array ('id' => $block->id, 'title' => $block->$title, 'content' => $block->$content);}, $product->blocks)
        );
    }, $products)));
  }

  public function set_lang ($id = 0) {
    identity ()->set_session ('is_en', $id ? true : false);
    redirect ('');
  }
  public function send () {
    $name = trim ($this->input_post ('name'));
    $email = trim ($this->input_post ('email'));
    $message = trim ($this->input_post ('comment'));

    if ($name && $email && $message) {
      $from = $email;
      $to = 'ofna@ofna-bio.com';
      $subject = "=?UTF-8?B?" . base64_encode ('Contact form') . "?=";

      $body = '';
      $body .= 'Name: ' . $name . "\n";
      $body .= 'Email: ' . $email . "\n";
      $body .= "Message: \n\n" . $message . "\n";

      mail ($to, $subject, $body, "From: <$from>");
    }
  }
}
