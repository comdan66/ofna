<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_news extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `news` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title_tw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description_tw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `date` date NOT NULL DEFAULT '" . date ('Y-m-d') . "',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `news`;"
    );
  }
}