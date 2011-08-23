<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "init.php";

/**
 * envee
 *
 * @package		 envee
 * @subpackage ThirdParty
 * @category	Modules
 * @author		
 */
class Envee_mcp {
	
	public $base;			// the base url for this module			
	
	public $form_base;		// base url for forms
	
	public $module_name = ENVEE_ADDON_NAME;
   
	public $vars = array();
	
	function Envee_mcp( $switch = TRUE )
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance(); 
		
		$this->base	 	 = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		
		$this->form_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		
		$this->ee_path = BASEPATH.'expressionengine/';
        
    //who are we?
    $this->member_id = $this->EE->session->userdata('member_id');
        
		$this->EE->cp->set_right_nav(array(
				'template_index'			=> $this->base,
			));
			
	}

	function index() 
	{
		$vars = array();
		return $this->content_wrapper('index');
	}

	function content_wrapper($content_view, $lang_key = '')
	{
		$this->vars['content_view'] = $content_view;
		
		$this->vars['mcp'] = $this;
		
		$this->EE->cp->set_variable('cp_page_title', lang(($lang_key) ? $lang_key : $content_view));
		
		$this->EE->cp->set_breadcrumb($this->base, lang('envee_name'));

		return $this->EE->load->view('_wrapper', $this->vars, TRUE);
	}
	
}