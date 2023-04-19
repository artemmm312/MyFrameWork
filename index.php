<?php

use Fw\Core\InstanceContainer;
use Fw\Core\Application;

require_once __DIR__ . "/Fw/init.php";

$app = InstanceContainer::getInstance(Application::class);

$app->header();
$app->getPage()->setProperty('h1', 'Шапочка');
$app->getPage()->setProperty('title', 'Мой заголовок');
$app->getPage()->setProperty('footer-div', 'Подвальчик');
$app->getPage()->addJs('script.js');
$app->getPage()->addCSS('style.css');
$app->getPage()->addString('<meta name="description" content="Мое описание">');
$app->getPage()->addString('<meta name="keywords" content="ключевые слова, мета-тег, SEO">');

?>

<pre>
-------- 19.04.2023 --------
1) создан класс Page для работы с содержимым html страницы
2) итд
-------- 18.04.2023 --------
1) создан конфиг и класс для работы с ними
2) создана функции авто регистрации классов
</pre>

<?php $app->footer(); ?>
