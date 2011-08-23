<?php

class Envee {
    
    public static $ENVIRONMENTS         = array();

    public static $SERVER_NAME    		= NULL;
    
    public static $ENV                  = NULL;
	
	 public static $DOC_ROOT				= NULL;
	
	 public static $SYSTEM_DIR				= NULL;
    
    protected static $initialized       = FALSE;
	
    protected static $envee_dir         = NULL;
	    
	/**
	* init
	*
	* @access public
	* 
	**/
	public static function init() 
	{ 
		if (Envee::$initialized === FALSE)
		{
			Envee::$envee_dir = dirname(__FILE__).'/';
			
			Envee::$ENVIRONMENTS = Envee::include_file(Envee::$envee_dir.'environments.php');
			
			Envee::$SERVER_NAME = $_SERVER["SERVER_NAME"];

			if (Envee::$ENV === NULL)
			{
				foreach (Envee::$ENVIRONMENTS as $env => $options) 
				{
					if (in_array(Envee::$SERVER_NAME, $options['names']))
					{
						Envee::$DOC_ROOT = rtrim(str_replace('environments/', '', Envee::$envee_dir), '/');
						Envee::$SYSTEM_DIR = (isset($options['system_dir'])) ? $options['system_dir'] : 'system';
						Envee::$ENV = strtoupper($env);
					}
				}
			}
		
			if (empty(Envee::$ENV)) 
			{
				Envee::$ENV = 'production';
			}
			
			Envee::$initialized = TRUE;
		}
	}

	/**
	* load_config
	*
	* @access public
	* @param  string Config file name
	* @return void
	* 
	**/
	public static function load_config($name) 
	{
		$config_path = Envee::$envee_dir.strtolower(Envee::$ENV).'/'.$name.'.php';
		return Envee::include_file($config_path);	
	}
	
	/**
	 * load_file
	 *
	 * @access public
	 * @param  void	
	 * @return void
	 * 
	 **/
	public static function include_file($file) 
	{
		if (file_exists($file))
		{
			return include $file;
		}
		else
		{
			/*
				TODO make better...
			*/
			//could not find it....
			echo "Include File: Could not find file ($file).\n";
			return NULL;
		}
	}	
}


Envee::init();
