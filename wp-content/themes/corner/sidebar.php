<ul id="sidebar">
	<?php
    if( is_singular() && is_active_sidebar('sidebar-post') ) {
		if( is_active_sidebar('sidebar-post-without-border') ) {
			dynamic_sidebar('sidebar-post-without-border');
		}
		dynamic_sidebar('sidebar-post');
	} else {
		if( is_active_sidebar('sidebar-without-border') ) { dynamic_sidebar('sidebar-without-border'); }
	
		if( ! is_active_sidebar('sidebar-main') ) { ?>
			<ul>
				<li id="archives" class="widget">
					<h3 class="widgetTitle"><?php _e( 'Archives', 'corner' ); ?></h3>
					<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>
				</li>
				<li id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'corner' ); ?></h3>
					<ul><?php wp_register(); ?><li><?php wp_loginout(); ?></li><?php wp_meta(); ?></ul>
				</li>
			</ul>
		<?php } else {
			dynamic_sidebar('sidebar-main');
		}
    }
    ?>
</ul>