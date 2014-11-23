<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
   xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	<head>
		<jdoc:include type="head" />
		
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/main.css" type="text/css" />

		
    	<!-- Custom Fonts Setup via Font-face CSS3 -->
    	<link rel="stylesheet" href="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template; ?>/fonts/fonts.css" type="text/css">

	    <!-- CSS files for plugins -->
	   	<link rel="stylesheet" href="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template; ?>/css/slidingmenu/slidingmenu.css" type="text/css" />
	    <link rel="stylesheet" href="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template; ?>/css/slidingmenu/main.css" type="text/css">

	   	<!-- gridloading -->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/gridloading/component.css" type="text/css" />	
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/gridloading/default.css" type="text/css" />	
	
		<!-- bower_components -->
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/jquery.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/jquery.bridget.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/eventie.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/EventEmitter.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/classie.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/imagesloaded.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/doc-ready.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/get-style-property.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/item.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/matches-selector.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/get-size.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/bower_components/outlayer.js" ></script>
		
		<!-- JS Plugins -->
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/modernizr.custom.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/masonry.pkgd.min.js" ></script> 
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/AnimOnScroll.js" ></script> 
		
		<!-- slidingmenu -->
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>bootstrap/js/bootstrap.js" type="text/javascript"></script>
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/slidingmenu.js"></script>
		<!-- main -->
		<script src="<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>javascripts/custom.js" ></script>
	
	<style type="text/css"> body{font-family:"Microsoft JhengHei";}</style>
	
	</head>
	<body>

		

		
		<?php if ($this->countModules('sidebar-menu')) : ?>
		<nav class="sidebarmenu" id="sm">
			<!--slidingmenu-->
			<div class="sm-wrap">
				<jdoc:include type="modules" name="sidebar-menu" style="no" />
			</div>
			<!--slidingtrigger-->
			<div id="sm-trigger" class="arrow-close"></div>		
		</nav>
		<?php endif; ?>

		<!-- Master Wrap : starts -->
		<section id="mastwrap" class="sliding">

			<jdoc:include type="message" />
			<!-- display demand -->
			<jdoc:include type="component" />
		
			<div id="centerBlock">
				<!-- search -->
				<div class='searchblock'>
					<jdoc:include type="modules" name="search"/>
				</div>
				<img class='centerBtn searchBtn' src='<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>images/search-01.png' alt='search'/>
				<!-- home   -->
				<a href='/minmin'><img class='centerBtn' src='<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>images/DtLogo-01.png' alt='home'/>
				</a>
				<!-- <jdoc:include type="modules" name="center"/> -->
				<!-- post -->
				<?php $user = JFactory::getUser();?>
				<?php if($user->guest):?>
				<img id='centerPost' class='centerBtn' src='<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>images/post-01.png' alt='post'/>
				<script language="javascript">
					var $K2 = jQuery.noConflict();
					$K2(document).ready(function(){
					  "use strict";
					  
					 $K2(document).on('click', '#centerPost', function() {
					 	$K2('#sm-trigger').toggleClass('active');
					    $K2('#sm-trigger').toggleClass('arrow-close');
					    $K2('#sm-trigger').toggleClass('arrow-open');
					    $K2('#mastwrap').toggleClass('sliding-toright');
					    $K2('#mastwrap').toggleClass('mastwrap-open');
					    $K2('#sm').toggleClass('menu-open');
					    $K2('#mastwrap').addClass('nav-opened');
						});
					   });
				</script>
				<?php else: ?>
				{modal index.php/post-demand}
				<img id='centerPost' class='centerBtn' src='<?php echo JURI::base(true); ?>/templates/<?php echo $this->template.'/'; ?>images/post-01.png' alt='post'/>
				{/modal}
				<?php endif; ?>	
			</div>
		</section>
		<!-- Master Wrap : ends -->	
		
		<jdoc:include type="modules" name="top" /> 
		<jdoc:include type="modules" name="right"/> 
			
	
	</body>
</html>

