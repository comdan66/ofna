<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ModelUploader d4_options
$d4_config['model_uploader']['absolute_path']         = FCPATH;
$d4_config['model_uploader']['base_path']             = 'upload'; // FCPATH/upload/
$d4_config['model_uploader']['separate_symbol']       = '_';
$d4_config['model_uploader']['save_original']         = false;
$d4_config['model_uploader']['auto_create_save_path'] = true;
$d4_config['model_uploader']['auto_add_file_format']  = true;
$d4_config['model_uploader']['base_url']              = base_url ();
$d4_config['model_uploader']['image_utility_class']   = 'imgk';


// WebStreamUtility d4_options
$d4_config['web_stream_utility']['time_limit']    = 30;
$d4_config['web_stream_utility']['temp_folder']   = sys_get_temp_dir ();
$d4_config['web_stream_utility']['temp_prefix']   = 'WSU_';
$d4_config['web_stream_utility']['save_path']     = 'temp'; // FCPATH/temp/
$d4_config['web_stream_utility']['absolute_path'] = FCPATH;

// FB API info
$d4_config['facebook']['appId']  = '1482020658677319';
$d4_config['facebook']['secret'] = '7a52b08ce21ff8ca7825d56c4326684d';
$d4_config['facebook']['scope']  = 'email, read_friendlists, photo_upload';

// http => http://xxx.xxx.xxx...
$d4_config['delay_request']['base_url'] = base_url (array ('delay'));

$d4_config['delay_request']['request_code_key'] = 'ccc';
$d4_config['delay_request']['request_code_value'] = 'ddd';

// http => http://xxx.xxx.xxx...
$d4_config['upload_picture']['base_url'] = base_url (array ('delay'));

// Upload picture conditions
$d4_config['upload_picture']['title_max_length']       = 50;
$d4_config['upload_picture']['description_max_length'] = 250;
$d4_config['upload_picture']['format_1s']              = array ('jpg','jpeg');
$d4_config['upload_picture']['format_2s']              = array ('image/jpeg', 'image/jpg');
$d4_config['upload_picture']['max_size']               = 3 * 1024 * 1024;
$d4_config['upload_picture']['duration']               = 50;
$d4_config['upload_picture']['is_enable']              = true;

// Minute
$d4_config['static_page_cache_time'] = 60;

// Minute
$d4_config['dynamic_page_cache_time'] = 10;