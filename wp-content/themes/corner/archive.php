<?php get_header(); ?>
	<div id="archive_meta">
		<?php
		if( is_category() ) {
			printf('<h2>%s</h2>', single_cat_title('', false));
			echo '<div class="detail"><ul>'; wp_list_categories('title_li=&depth=1'); echo '</ul></div>';
		} elseif( is_tag() ) {
			printf('<h2>%s</h2>', single_tag_title('', false) );
		} elseif( is_day() ) {
			printf('<h2>%s</h2>', get_the_time(__('M jS, Y','corner')));
			echo '<div class="detail"><ul>'; wp_get_archives('type=daily&limit=9'); echo '</ul></div>';
		} elseif( is_month() ) {
			printf('<h2>%s</h2>', get_the_time(__('M, Y','corner')));
			echo '<div class="detail"><ul>'; wp_get_archives('type=monthly&limit=9'); echo '</ul></div>';
		} elseif( is_year() ) {
			printf('<h2>%s</h2>', get_the_time(__('Y','corner')));
			echo '<div class="detail"><ul>'; wp_get_archives('type=yearly&limit=9'); echo '</ul></div>';
		} elseif( is_author() ) {
			echo '<h2 class="nodetail">'; _e('Author Archives','corner'); echo '</h2>';
		} elseif( is_search() ) {
			echo '<h2 class="nodetail">'; _e('Search Results: ','corner'); echo $s.'</h2>';
		} elseif( isset($_GET['paged']) && !empty($_GET['paged']) ) {
			echo '<h2 class="nodetail">'; _e('Blog Archives','corner'); echo '</h2>';
		} ?>
	</div>
	<div id="main_col">
		<?php get_template_part('loop','index'); ?>
	</div>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>