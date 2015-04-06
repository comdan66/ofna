<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_new_blocks extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `new_blocks` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `new_id` int(11) NOT NULL,
        `sort` int(11) NOT NULL DEFAULT '0',
        `title_tw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `content_tw` text,
        `content_en` text,
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`),
        KEY `new_id_index` (`new_id`),
        FOREIGN KEY (`new_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `new_blocks`;"
    );
  }
}