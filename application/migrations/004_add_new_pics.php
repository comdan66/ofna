<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_new_pics extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `new_pics` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `new_id` int(11) NOT NULL,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
      "DROP TABLE `new_pics`;"
    );
  }
}