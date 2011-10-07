<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//load envee
require_once FCPATH.'../environments/init.php';

/*
|--------------------------------------------------------------------------
| ExpressionEngine Config Items
|--------------------------------------------------------------------------
|
| The following items are for use with ExpressionEngine.  The rest of
| the config items are for use with CodeIgniter, some of which are not
| observed by ExpressionEngine, e.g. 'permitted_uri_chars'
|
*/

//load the proper environments config
$config = Envee::load_config('config');

//you can put global overrides here... examples....
$config['app_version'] = '222';
$config['install_lock'] = "";
$config['license_number'] = "";
$config['doc_url'] = "http://expressionengine.com/user_guide/";
$config['is_system_on'] = "y";
$config['allow_extensions'] = 'y';
$config['site_label'] = '';
$config['cookie_prefix'] = '';
$config['encryption_key'] = "";


/* End of file config.php */
/* Location: ./system/expressionengine/config/config.php */