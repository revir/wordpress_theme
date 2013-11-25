<?php get_header(); ?>
		<div class="post">
			<h2><?php _e('No matching results','corner'); ?></h2>
			<div class="entry">
				<p><?php _e('You seem to have found a mis-linked page or search query with no matching results. Please trying your search again. If you feel that you should be staring at something a little more concrete, feel free to email the author of this site or browse the archives.','corner'); ?></p>
				<p><?php get_search_form(); ?></p>
				<p class="suggest_404"><strong><?php _e('Tag Cloud:','corner'); ?></strong> <?php wp_tag_cloud(
				'number=25&largest=12&smallest=8&order=RAND') ?></p>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>