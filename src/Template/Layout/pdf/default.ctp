<?php
use Cake\Core\Configure;
$cakeDescription = 'PDF File';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
		<?= Configure::read('App.title'); ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('cake.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('pdf-css.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('bootstrap.css', ['fullBase' => true]) ?>
	
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body class="home">

	<header class="row">
		<div class="header-image"><?= $this->Html->image('logo-login.png', ['fullBase' => true]); ?></div>
	</header>

	<?= $this->fetch('content') ?>
	
</body>

</html>