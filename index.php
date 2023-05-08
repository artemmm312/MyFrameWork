<?php

use Fw\Core\InstanceContainer;
use Fw\Core\Application;

require_once __DIR__ . "/Fw/init.php";

$app = InstanceContainer::getInstance(Application::class);

$app->header();
$app->getPage()->setTitle('MyFramework');
$app->getPage()->setDescription('собственный мини-фреймворк');
$app->getPage()->setKeywords('ключевые слова, мета-тег, SEO');
$app->getPage()->addJs('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>');
$app->getPage()->addCSS('<link href="Fw/templates/login/css/headers.css" rel="stylesheet">');
$app->getPage()->addCSS('<link href="Fw/templates/login/css/footer.css" rel="stylesheet">');
$app->getPage()->addCSS('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">');


$app->includeComponent('View:Form', 'form',
	[
		'additional_class' => 'myForm',
		'attr' =>
			[
				'data-form-id' => 'form-123'
			],
		'method' => 'post',
		'action' => '#',
		'elements' =>
			[
				[
					'component' => 'FormElements:Input',
					'template' => 'text',
					'params' =>
						[
							'name' => 'login',
							'id' => 'inputLogin',
							'title' => 'Логин',
							'placeholder' => 'Введите логин',
						]
				],
				[
					'component' => 'FormElements:Input',
					'template' => 'password',
					'params' =>
						[
							'name' => 'password',
							'id' => 'inputPassword',
							'title' => 'Пароль',
							'placeholder' => 'Введите пароль',
						]
				],
				[
					'component' => 'FormElements:Check',
					'template' => 'checkBox',
					'params' =>
						[
							'title' => 'Чекбокс',
							'id' => 'checkBox',
							'value' => '1',
						]
				],
				[
					'component' => 'FormElements:Check',
					'template' => 'radio',
					'params' =>
						[
							'title' => 'Радио',
							'id' => 'radio',
						]
				],
				[
					'component' => 'FormElements:Select',
					'template' => 'select',
					'params' =>
						[
							'aria-label' => 'Пример селекта',
							'title' => 'Селект',
							'id' => 'select',
							//'multiple' => 'multiple',
							'options' =>
							[
								[
									'selected' => false,
									'value' => '1',
									'text' => 'ABC',
								],
								[
									'selected' => false,
									'value' => '2',
									'text' => 'DEF',
								],
								[
									'selected' => false,
									'value' => '3',
									'text' => 'GHI',
								]
							]
						]
				],
				[
					'component' => 'FormElements:TextArea',
					'template' => 'textarea',
					'params' =>
					[
						'id' => 'textarea',
						'title' => 'Текстовое поле',
						'rows' => '3',
					]
				]
			],
	]
);

$app->includeComponent('View:Main', 'theme_1', ['hello' => 'Hello!']);

?>


<pre>
-------- 08.05.2023 --------
	1) Создал файловую структуру компонента формы
	2) Создал шаблоны для каждого компонента
	
-------- 07.05.2023 --------
	1) Создал файловую структуру компонентов элементов формы
	2) Добавил метод renderProperty в Template
	
-------- 02.05.2023 --------
	1) Добавил полноценные header и footer. Подключил Bootstrap
	2) Создал файловую структуру нового компонента
	3) Немного изменил старый компонент и его шаблон, и добавил свойство Application $app в Template
	
-------- 27.04.2023 --------
	1) Оптимизировал Application::includeComponent(), добавил свойство $components в котором хранятся имена классов
		подключаемых компонентов
	2) Добавил трейт с методом проверки существования файла, подключения и возврата его абсолютного пути
	3) Исправил Template::render()
	4) Добавил маску макроса "property" в массив макросов Page, внёс соответствующие изменения в методы Page
	5) Оптимизировал механизм подстановки пустой строки на неопределенные property в Page
	
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
//$request = $app->getRequest();
//$server = $app->getServer();
//$session = $app->getSession();
//var_dump($request);
//var_dump($server);
//var_dump($session);
?>
