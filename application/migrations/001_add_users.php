<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

  public function up () {
    $sql = "CREATE TABLE `users` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `uid` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
              `is_enabled` int(11) NOT NULL DEFAULT '1',
              `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $this->db->query ($sql);
  }
}