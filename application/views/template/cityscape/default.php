<!doctype html>
<html lang="<?php echo I18n::$lang ?>">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">	
		<?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
		<?php foreach ($scripts_upper as $file) echo HTML::script($file), PHP_EOL ?>
		<?php foreach ($scripts_manual as $file) echo '<script>'.PHP_EOL.$file.PHP_EOL.'</script>', PHP_EOL ?>
		<?php foreach ($scripts_lower as $file) echo HTML::script($file), PHP_EOL ?>
	</head>
	<body>
		<div id="container_status">
			<?php echo View::factory('template/cityscape/components/status')->render(); ?>
		</div>
		<div id="container_main" class="container_16">
			<?php echo View::factory('template/cityscape/components/header')->render(); ?>
			<?php echo $content ?>
			<?php echo View::factory('template/cityscape/components/footer')->render(); ?>
		</div>
	</body>
</html>
