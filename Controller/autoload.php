<?php 


function autoloader($class)
{
	include '../Model/'.$class.'.php';
}

spl_autoload_register('autoloader');
 ?>