<?php global $Wcms ?>

<!DOCTYPE html>
<?php
if(defined('VERSION') && !defined('version'))
	define('version', VERSION);
if(version<'2.0.0')
	defined('INC_ROOT') OR die('Direct access is not allowed.');

$Wcms->addListener('menu', 'colorSelector');

function colorSelector ($args) {
	$args[0] .= '
<li>
	<ul class="color-selector">
		<li><a href="" id="colorred"><span class="glyphicon glyphicon-globe" style="color: red;" aria-hidden="true"></span></a></li><li><a href="" id="colorgreen"><span class="glyphicon glyphicon-globe" style="color: green;" aria-hidden="true"></span></a></li><li><a href="" id="colorblue"><span class="glyphicon glyphicon-globe" style="color: blue;" aria-hidden="true"></span></a></li>
	</ul>
</li>';
	return $args;
}
if(isset($_COOKIE['stylesheet'])) {
	switch($_COOKIE['stylesheet']) {
		case 'colorred':
			$css = 'css/style-red.css';
			break;
		case 'colorgreen':
			$css = 'css/style-green.css';
			break;
		default:
			$css = 'css/style-blue.css';
			break;
	}
} else {
	$css = 'css/style-blue.css';
}
?>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    	
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	
        <title><?= $Wcms->get('config', 'siteTitle') ?> - <?= $Wcms->page('title') ?></title>
        <meta name="description" content="<?= $Wcms->page('description') ?>">
        <meta name="keywords" content="<?= $Wcms->page('keywords') ?>">
    	
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <?= $Wcms->css() ?>
	<link id="stylesheet" rel="stylesheet" href="<?= $Wcms->asset($css) ?>">

    </head>
    <body>
        <?= $Wcms->settings() ?>
	<?= $Wcms->alerts() ?>

    	<nav class="navbar navbar-default">
    		<div class="container css3-shadow colorBackground">
    			<div class="navbar-header">
    				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">
    					<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    				</button>
    				<a class="navbar-brand" href="<?= $Wcms->url() ?>">
    					<?= $Wcms->get('config', 'siteTitle') ?>
    
    				</a>
    			</div>
    			<div class="collapse navbar-collapse" id="menu-collapse">
    				<ul class="nav navbar-nav navbar-right">
                        <?= $Wcms->menu() ?>

    				</ul>
    			</div>
    		</div>
    	</nav>
    
    	<div class="container-fluid">
    		<div class="row-fluid">
    			<div class="col-xs-12 col-sm-8">
    			<div class="box css3-shadow whiteBackground padding40">
                    <?= $Wcms->page('content') ?>
    
    			</div>
    			</div>
    			<div class="col-xs-12 col-sm-4">
    			<div class="box css3-shadow whiteBackground padding40">
                <?= $Wcms->block('subside') ?>
    
    			</div>
    			</div>
    		</div>
    	</div>
    
    	<footer class="container-fluid">
    		<div class="box css3-shadow whiteFont colorBackground padding20">
                <?= $Wcms->footer() ?>
    
    		</div>
    	</footer>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <?= $Wcms->js() ?>

    	<script src="<?= $Wcms->asset('js/js.cookie.js') ?>"></script>
    	<script>
    		$( document ).ready(function() {
    			$('body').css('margin-bottom', $('footer').height()+'px');
    			function change_stylesheet(c) {
    				switch(c) {
    					case 'colorred':
    						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-red.css');
    						break;
    					case 'colorgreen':
    						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-green.css');
    						break;
    					case 'colorblue':
    						var stylesheet = $('#stylesheet').attr('href').replace(/css\/style\-(.*)/g, 'css/style-blue.css');
    						break;
    				}
    				Cookies.set("stylesheet", c, { expires: 365 });
    				$("#stylesheet").attr({href: stylesheet});
    			}
    			
    			if(Cookies.get("stylesheet")) {
    				change_stylesheet(Cookies.get("stylesheet"));
    			}
    			
    			$('.color-selector li a').click(function(e){
    				e.preventDefault();
    				change_stylesheet($(this).attr('id'));
    			});			
    		});
    	</script>
    </body>
</html>
