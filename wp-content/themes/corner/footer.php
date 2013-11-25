	<div class="clearfix"></div>
	<div id="footer">
		<?php $options = get_option('corner_options'); if($options['footer_content']) { echo($options['footer_content']); } else { ?>
			<span><?php _e('Copyright','corner'); ?> &copy; 2011 <?php bloginfo('name'); ?></span>
		<?php } ?>
		<?php if( $options['footer_menu_enable'] ) echo '<p>'.wp_nav_menu(array('theme_location'=>'footer','depth'=>1)).'</p>'; ?>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>