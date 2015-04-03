<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

if (verifyArray ($javascript_list))
  foreach ($javascript_list as $javascript)
    echo $javascript['exist'] ? (script_tag ($javascript['src']) . "\n") : ("<!-- not exist! " . script_tag ($javascript['src']) . " -->\n");
