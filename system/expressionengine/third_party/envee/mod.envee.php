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
class Envee {

	var $return_data;
    
	function  Envee()
	{	
		$this->EE =& get_instance(); // Make a local reference to the ExpressionEngine super object 
	}
	
}
