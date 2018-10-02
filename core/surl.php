<?php
//	семантические ссылки, или ЧПУ
if (!defined('_PLUGSECURE_'))
{
  header('Location: ../403.html');
}

class surl{
	
	private static $className = "ЧПУ";


	public static function parseUrl($type)
	{
		$data = array();

		if($type == 1)
		{
			if ($_SERVER['REQUEST_URI'] != '/')
			{
				$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
				$uri_parts = explode('/', trim($url_path, ' /'));
				if (count($uri_parts) % 2) 
				{
					$uri_parts = explode('&', trim($url_path, ' /'));
					if(isset($_GET['module']) & isset($_GET['action']))
					{
						$data['module'] = $_GET['module'];
						$data['action'] = $_GET['action'];
						unset($_GET['module']);
						unset($_GET['action']);
						foreach ($_GET as $key => $value)
						{
							$data['params'][$key] = $value;
						}
					}
					else
					{
						die('Запрос не может быть обработан.');
					}
				}
				else
				{
					$data['module'] = array_shift($uri_parts);
					$data['action'] = array_shift($uri_parts);

					for ($i=0; $i < count($uri_parts); $i++) 
					{
						$data['params'][$uri_parts[$i]] = $uri_parts[++$i];
					}
				}
			}
			return $data;
		}
		else
		{
			if ($_SERVER['REQUEST_URI'] != '/')
			{
				$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
				$uri_parts = explode('&', trim($url_path, ' /'));
				if(isset($_GET['module']) & isset($_GET['action']))
				{
					$data['module'] = $_GET['module'];
					$data['action'] = $_GET['action'];
					unset($_GET['module']);
					unset($_GET['action']);
					foreach ($_GET as $key => $value)
					{
						$data['params'][$key] = $value;
					}
				}
				else
				{
					die('Запрос не может быть обработан.');
				}
			}
			return $data;
		}
	}

	public static function getClassName()
	{		
		return self::$className;	
	}
}
?>