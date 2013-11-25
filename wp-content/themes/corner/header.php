<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_enqueue_script('jquery'); wp_enqueue_script('corner-main'); ?>
<?php if(is_singular()){ wp_enqueue_script('comment-reply'); wp_enqueue_script('corner-comment'); } ?>
<?php $options = get_option('corner_options'); if( $options['title_font_size'] != 40 ) { ?>
<style type="text/css">#header h1 a{font-size: <?php echo $options['title_font_size']; ?>px;}</style>
<?php } wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="header">
	<div class="title">
		<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
		<?php if( $options['header_tagline'] ) { echo '<h2>'; echo bloginfo('description'); echo '</h2>';} ?>
	</div>
	<div id="topmenu" class="alignright">
		<?php wp_nav_menu(array('theme_location'=>'main')); ?>
		<div id="search_button"><?php _e('Search','corner'); ?></div>
		<?php get_search_form(); ?>
		<?php if( $options['subscribe_menu'] ) { ?>
			<div id="subscribe">
				<?php wp_nav_menu(array('theme_location'=>'sub','depth'=>1)); ?>
			</div>
		<?php } ?>
	</div>
	<?php if( $options['use_banner'] ) { ?>	<div id="banner" <?php if( $options['random_banner'] ) echo 'class="random"' ?>></div><?php } ?>
</div>
<div class="clearfix"></div>
<div id="content">