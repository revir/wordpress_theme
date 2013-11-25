<?php get_header(); ?>
	<div id="main_col">
		<div class="post">
			<h2><?php _e('404 Not Found','corner'); ?></h2>
			<div class="entry">
				<p><?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.','corner'); ?></p>
				<p><?php get_search_form(); ?></p>
				<p class="suggest_404"><strong><?php _e('Tag Cloud:','corner'); ?></strong> <?php wp_tag_cloud(
				'number=25&largest=12&smallest=8&order=RAND') ?></p>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>