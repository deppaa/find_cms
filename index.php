<?php
define( "_PLUGSECURE_", true);
require_once('core/registry.php');
$registry = Registry::singleton();
$registry->config = 'core/config.php';
$registry->database = 'core/database.php';
$registry->surl = 'core/surl.php';
 
//выводим имена подключенных модулей
echo '<b><un>Подключено</un></b>';
foreach ($registry->getObjectsList() as $names)
{
	echo '<li>' . $names . '</li>';
}

$db = $registry->database->connect($registry->config::$database);
echo $registry->database->dbPing();

echo "<hr /><br />";
$q_res = $db->query("SHOW TABLES LIKE 'test'");
if(!empty($q_res->fetch_row()))
{
	echo "Таблица уже существует<br />";
}
else
{
	echo "Таблица не найдена. Пробуем создать...";
	$query = "CREATE TABLE `test` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`text` TEXT NULL,
				PRIMARY KEY (`id`)
				)
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;";
	if($db->query($query))
	{
		echo "Таблица была создана!<br />";
	}
	else
	{
		echo "Возникла ошибка, попробуйте еще раз.<br />";
	}
}

echo '
	<form method="post" action="index.php">
		Введите текст:<br />
		<textarea name="text"></textarea><br />
		<input type="submit" name="send" value="GO!" />
	</form><br />';

if(!empty($_POST['send']))
{
	if(!empty($_POST['text']))
	{
		$query = "INSERT INTO `test` (`text`) VALUES ('" . $_POST['text'] . "')";
		$result = $db->query($query);
		if($db->error)
		{
			echo "ОШИБКА!<br />";
		}
		else
		{
			echo "Запрос выполнен.<br />";
		}
	}
}

$result = $db->query("SELECT * FROM `test`");
while($res = $result->fetch_assoc())
{
	echo $res['id'] . ": " . $res['text'] . "
";
}

echo "";
echo "Проверка работы ЧПУ:";
$chpu_data = $registry->surl->parseUrl($registry->config::$s_url);
foreach ($chpu_data as $key => $value) {
	if($key != 'params')
	{
		echo $key . ': ' . $value . '';
	}
	else
	{
		echo "PARAMS:";
		foreach ($value as $key2 => $value2) {
			echo $key2 . ': ' . $value2 . '';
		}
	}
}

?>