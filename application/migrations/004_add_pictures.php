<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_pictures extends CI_Migration {

  public function up () {
    $sql = "CREATE TABLE `pictures` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `user_uid` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `user_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `file_name` varchar(256) NOT NULL DEFAULT '',
              `proportion` varchar(256) NOT NULL DEFAULT '0',
              `is_enabled` int(11) NOT NULL DEFAULT '1',
              `is_sync` int(11) NOT NULL DEFAULT '0',
              `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

    $this->db->query ($sql);
  }
}
