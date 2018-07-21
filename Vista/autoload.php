<?php 


function autoloaderr($class)
{
	include '../Model/'.$class.'.php';
}

spl_autoload_register('autoloaderr');
 ?>