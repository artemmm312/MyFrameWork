<?php

use Fw\Core\InstanceContainer;
use Fw\Core\Application;

require_once __DIR__ . "/Fw/init.php";

$app = InstanceContainer::getInstance(Application::class);

$app->header();
$app->getPage()->setTitle('Какой-то заголовок');
$app->getPage()->setDescription('Какое-то описание');
$app->getPage()->setKeywords('ключевые слова, мета-тег, SEO');
$app->getPage()->addJs('script.js');
$app->getPage()->addCSS('style.css');
$app->getPage()->addString('<script type="text/javascript">alert("Здравствуйте уважаемый!")</script>');
$app->getPage()->setProperty('h1', 'Шапочка');
$app->getPage()->setProperty('footer-div', 'Подвальчик');

?>

<pre>
-------- 19.04.2023 --------
	1) доработал классы Application и Page
	2) создал страницу истории изменения проекта
	
-------- 18.04.2023 --------
	1) добавил инициализацию Page в конструктор Application в поле $pager
	2) доработал InstanceContainer с использование ReflectionAPI
	
-------- 17.04.2023 --------
	1) добавил константу подключения ядра в init.php и проверку его наличия в подключаемых файлах
	2) создал класс Page
	
-------- 16.04.2023 --------
	1) создал класс реализующий контейнер инстансов InstanceContainer
	2) создал структуру шаблона сайта
	3) доработал класс Application, внедрил буфер
	
-------- 14.04.2023 --------
	1) создал структуру файлов
	2) создан конфиг и класс для работы с ними
	3) создана функции авто регистрации классов
	4) создал основной класс приложения
</pre>

<?php $app->footer(); ?>
