<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_products extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_tag_id` int(11) NOT NULL,
        `title_tw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description_tw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`),
        KEY `product_tag_id_index` (`product_tag_id`),
        FOREIGN KEY (`product_tag_id`) REFERENCES `product_tags` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `products`;"
    );
  }
}