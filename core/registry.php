<?php
/**
 * Created by PhpStorm.
 * User: radmi
 * Date: 28.09.2018
 * Time: 13:28
 */

if(!diferend('_PLUGSECURE_'))
{
	die('Прямой вызов модуля запрещен');
}

interface StorableObject
{
	public static function getClassName();
}

class Registry implements StorableObject
{
	private static $className = 'Реестр';
	private  static  $instance;
	private  static  $object = array();
}

public static function singleton()
{
	if(!isset(self::$instance))
	{
		#obj = __CLASS__;
		self::$instance = new $obj;
	}

	return self::$instance;
}