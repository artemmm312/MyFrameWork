<?php

use Fw\Core\InstanceContainer;
use Fw\Core\Application;

require_once __DIR__ . "/Fw/init.php";

$app = InstanceContainer::getInstance(Application::class);

$app->header();
$app->getPage()->setTitle('Какой-то заголовок');
$app->getPage()->setDescription('Какое-то описание');
$app->getPage()->setKeywords('ключевые слова, мета-тег, SEO');
//$app->getPage()->addJs('script.js');
$app->getPage()->addJs('<script async src="script.js"></script>');
//$app->getPage()->addCSS('style.css');
$app->getPage()->addCSS('<link href="style.css" type="text/css" rel="stylesheet">');
$app->getPage()->addString('<script type="text/javascript">alert("Здравствуйте уважаемый!")</script>');
$app->getPage()->setProperty('h1', 'Шапочка');
$app->getPage()->setProperty('footer-div', 'Подвальчик');
$app->includeComponent('View:Main', 'theme_1', []);
?>

<pre>
-------- 23.04.2023 --------
	1) Изменил класс Page:
		1.1) изменил добавление js, css и string сразу тегом и хэшом в массив
		1.2) изменил свойство $page из статического в обычное
	2) Добавил контекст в конструктор Application
	
-------- 22.04.2023 --------
	1) Создал структуру компонентов с namespace View
	2) Добавил в Application метод includeComponent
	
-------- 21.04.2023 --------
	1) Создал базовый класс компонентов Base
	2) Создал Базовый класс шаблонов Template
	
-------- 20.04.2023 --------
	1) Создал класс Dictionary
	2) создал классы Request, Server и Session, наследуемые от Dictionary, и заполняемые одноименными глобальными массивами
	3) Модифицировал класс Application: при инициализации создаются 3 выше описанных класса в контейнере InstanceContainer.
	И добавил методы получения экземпляров этих классов из контейнера.
	
-------- 19.04.2023 --------
	1) Доработал классы Application и Page
	2) Создал страницу истории изменения проекта
	
-------- 18.04.2023 --------
	1) Добавил инициализацию Page в конструктор Application в поле $pager
	2) Доработал InstanceContainer с использование ReflectionAPI
	
-------- 17.04.2023 --------
	1) Добавил константу подключения ядра в init.php и проверку его наличия в подключаемых файлах
	2) Создал класс Page
	
-------- 16.04.2023 --------
	1) Создал класс реализующий контейнер инстансов InstanceContainer
	2) Создал структуру шаблона сайта
	3) Доработал класс Application, внедрил буфер
	
-------- 14.04.2023 --------
	1) Создал структуру файлов
	2) Создан конфиг и класс для работы с ними
	3) Создана функции авто регистрации классов
	4) Создал основной класс приложения
</pre>

<?php $app->footer(); ?>

<?php
/*$request = $app->getRequest();
$server = $app->getServer();
$session = $app->getSession();
var_dump($request);
var_dump($server);
var_dump($session);*/
$app->includeComponent('View:Main', 'theme_1', []);

?>
