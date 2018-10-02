<?php
if (!defined('_PLUGSECURE_'))
{
  header('Location: ../403.html');
}

class Config 
{
	//имя модуля, читаемое
	private static $className = 'Конфиг';

	//Конфигурация подключения к БД
	public static $database = array(
		'host' => 'localhost',
		'port' => '3306',
		'user' => 'root',
		'pass' => '',
		'base' => 'find-cms',
	);

	//ЧПУ 1 - on, 0 - off.
	public static $s_url = 1;

	public static function getClassName()
	{		
		return self::$className;	
	}

}
?>