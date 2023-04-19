<?php if (!defined('CORE')) {
	die;
} ?>

<head>
	<title><?php $this->getPage()->showTitle(); ?></title>
	<meta name="description" content=<?php $this->getPage()->showDescription(); ?>>
	<meta name="keywords" content=<?php $this->getPage()->showKeywords(); ?>>
	<?php $this->getPage()->showHead(); ?>

</head>
<header>
	<h1><?php $this->getPage()->showProperty('h1'); ?></h1>
	<div><?php $this->getPage()->showProperty('undefined'); ?></div>
</header>
<body>

