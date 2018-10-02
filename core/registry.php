<?php

if (!defined('_PLUGSECURE_'))
{
	header('Location: ../403.html');
}

interface StorableObject
{
	public static function getClassName();
}

class Registry implements StorableObject
{
	private static $className = 'Реестр';
	private static $instance;
	private static $objects = array();


	public static function singleton()
	{
		if( !isset( self::$instance ) )
		{
			$obj = __CLASS__;
			self::$instance = new $obj;
		}

		return self::$instance;
	}

	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}
	private function __sleep() {}

	public function addObject($key, $object)
	{
		require_once($object);
		self::$objects[$key] = new $key(self::$instance);	
	}

	public function __set($key, $object)
	{
		$this->addObject($key, $object);	
	}

	public function getObject($key)
	{
		if ( is_object(self::$objects[$key]))
		{
			return self::$objects[$key];	
		}
	}

	public function __get($key)
	{
		if ( is_object(self::$objects[$key]))
		{
			return self::$objects[$key];	
		}
	}

	public function getObjectsList()
	{
		$names = array();
		foreach(self::$objects as $obj) 
		{
        	$names[] = $obj->getClassName();
    	}
		array_push($names, self::getClassName());
		return $names;
	}

	public static function getClassName()
	{		
		return self::$className;	
	}
}

?>