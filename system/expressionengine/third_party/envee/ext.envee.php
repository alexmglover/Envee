<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "init.php";

/**
 * envee
 *
 * @package		 envee
 * @subpackage ThirdParty
 * @category	Extensions
 * @author		
 */
class Envee_ext {

    public $settings       = array();

    public $name           = ENVEE_NAME;

    public $version        = ENVEE_VERSION;

    public $description    = '';

    public $settings_exist = 'n';

    public $docs_url       = 'http://';

    function Envee_ext($settings = '') 
    {
        $this->EE =& get_instance();
    }
    
    /**
     * Install the extension
     */
    function activate_extension()
    {
        // Delete old hooks
        $this->EE->db->query("DELETE FROM exp_extensions WHERE class = '". __CLASS__ ."'");
        
        // Add new hooks
        $ext_template = array(
            'class'    => __CLASS__,
            'settings' => '',
            'priority' => 10,
            'version'  => $this->version,
            'enabled'  => 'y'
        );
        
 				# array('hook'=>'', 'method'=>''),
        $extensions = array();
        
        foreach($extensions as $extension)
        {
            $ext = array_merge($ext_template, $extension);
            $this->EE->db->insert('exp_extensions', $ext);
        }       
    }

    function update_extension($current = '') {}

    function disable_extension() 
    {
        $this->EE->db->query("DELETE FROM exp_extensions WHERE class = '" . __CLASS__ . "'");
    }

}