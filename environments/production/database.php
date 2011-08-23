<?php 

$db['expressionengine']['hostname'] = "localhost";
$db['expressionengine']['username'] = "";
$db['expressionengine']['password'] = "";
$db['expressionengine']['database'] = "";
$db['expressionengine']['dbdriver'] = "mysql";
$db['expressionengine']['dbprefix'] = "exp_";
$db['expressionengine']['pconnect'] = FALSE;
$db['expressionengine']['swap_pre'] = "exp_";
$db['expressionengine']['db_debug'] = TRUE;
$db['expressionengine']['cache_on'] = FALSE;
$db['expressionengine']['autoinit'] = FALSE;
$db['expressionengine']['char_set'] = "utf8";
$db['expressionengine']['dbcollat'] = "utf8_general_ci";
$db['expressionengine']['cachedir'] = Envee::$DOC_ROOT."/".Envee::$SYSTEM_DIR."/expressionengine/cache/db_cache/";

return $db;

?>