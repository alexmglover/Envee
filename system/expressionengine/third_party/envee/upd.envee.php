<?php	 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "init.php";

/**
 * envee Module
 *
 * @package		envee
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		
 */
class Envee_upd {
		
	public $version		= ENVEE_VERSION; 
	
	public $module_name 	= ENVEE_ADDON_NAME;
	
	public $models 		= array();
	
	function Envee_upd( $switch = TRUE ) 
	{ 
		$this->EE =& get_instance();
	} 

	/**
	 * Installation Method
	 *
	 * @return 	boolean 	TRUE
	 */
	public function install()
	{
		$this->EE->load->dbforge();

		$data = array(
			'module_name' 				=> $this->module_name,
			'module_version' 			=> $this->version,
			'has_cp_backend' 			=> 'y',
			'has_publish_fields'	=> 'n'
		);

		$this->EE->db->insert('modules', $data);		
		
		foreach ($this->actions as $action_data) 
		{
			$this->EE->db->insert('actions', $action_data);  
		}
		
		foreach ($this->models as $model_name) 
		{
			$this->_install_model($model_name);
		}
		
		return TRUE;
	}
	
	/**
	 * uninstall
	 *
	 * @return 	boolean 	TRUE
	 */	
	public function uninstall()
	{
		$mod_id = $this->EE->db->select('module_id')
			->get_where('modules', array('module_name'	=> $this->module_name))
			->row('module_id');

		$this->EE->db->where('module_id', $mod_id)
			->delete('module_member_groups');

		$this->EE->db->where('module_name', $this->module_name)
			->delete('modules');

		$this->EE->db->where('class', $this->module_name)
			->delete('actions');
				
		$this->EE->load->dbforge();
		
		foreach ($this->models as $model_name) 
		{
			$this->_uninstall_model($model_name);
		}
					
		return TRUE;
	}
		
	/**
	 * Module Updater
	 *
	 * @return 	boolean 	TRUE
	 */	
	public function update($current = '')
	{
		$this->EE->load->dbforge();
		
		if ( ! $current || $current === $this->version)
		{
			return FALSE;
		}
		
		if (version_compare($current, '1.0.1', "<"))
		{

		}
		
		return TRUE;
	}
	
	/**
	 * _install_model
	 *
	 * @access public
	 * @param  void	
	 * @return void
	 * 
	 **/
	public function _install_model($model_name) 
	{	
		$this->EE->load->model($model_name);
		
		$this->EE->dbforge->add_field($this->EE->$model_name->db_fields);	
		
		if ($this->EE->$model_name->pk)	
		{
			if ($this->EE->$model_name->has_autoincrement_field())
			{
				$this->EE->dbforge->add_key($this->EE->$model_name->pk, TRUE);
			}
			else
			{
				$this->EE->dbforge->add_key($this->EE->$model_name->pk);
			}
		}
		
		$this->EE->dbforge->create_table($this->EE->$model_name->table_name);
	}
	
	
	
	/**
	 * _uninstall_model
	 *
	 * @access public
	 * @param  void	
	 * @return void
	 * 
	 **/
	public function _uninstall_model($model_name) 
	{	
		$this->EE->load->model($model_name);
		
		$table_name = $this->EE->$model_name->table_name;
		
		if ($this->EE->db->table_exists('exp_'.$table_name))
		{	
			$this->EE->dbforge->drop_table($table_name);
		}
	}
		
}