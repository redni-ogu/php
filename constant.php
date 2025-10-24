<?php
/*
ЗАДАНИЕ 1
- Создайте константу и присвойте ей значение.
*/
define("SITE_NAME", "Мой сайт");
const VERSION = "1.0.0";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Константы</title>
</head>
<body>
	<h1>Константы</h1>
	<?php
	/*
	ЗАДАНИЕ 2
	- Проверьте, существует ли константа, которую Вы хотите использовать.
	- Выведите значение созданной константы.
	*/
	if (defined("SITE_NAME")) {
		echo "Название сайта: " . SITE_NAME . "<br>";
	} else {
		echo "Константа SITE_NAME не определена<br>";
	}
	
	if (defined("VERSION")) {
		echo "Версия приложения: " . VERSION . "<br>";
	} else {
		echo "Константа VERSION не определена<br>";
	}
	
	/*
	ЗАДАНИЕ 3
	- Используя предопределённые в ядре константы выведите текущую версию PHP.
	- Используя магические константы выведите директорию скрипта.
	*/
	echo "Текущая версия PHP: " . PHP_VERSION . "<br>";
	echo "Операционная система: " . PHP_OS . "<br>";
	echo "Директория скрипта: " . __DIR__ . "<br>";
	echo "Файл скрипта: " . __FILE__ . "<br>";
	echo "Строка кода: " . __LINE__ . "<br>";
	?>
</body>
</html>