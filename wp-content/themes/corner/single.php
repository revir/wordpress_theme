<?php get_header(); ?>
	<div id="main_col">
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="title">
					<h2><?php the_title(); ?></h2>
					<span class="comments">
						<?php if(!comments_open()) { echo '<a>X</a>'; } else { comments_popup_link('0','1','%'); }?>
					</span>
				</div>
				<div class="entry">
					<?php the_content(''); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'corner' ), 'after' => '</div>' ) ); ?>
				</div>
				<div class="post_meta">
					<span class="date alignright"><?php the_time(__('M jS, Y','corner')); ?></span>
					<span class="cats alignleft"><strong><?php _e('Categories:','corner'); ?></strong> <?php the_category(', ', 'multiple'); ?></span>
					<span class="tags"><strong><?php _e('Tags:','corner'); ?></strong> <?php the_tags( '', ', ', ''); ?></span>
					<?php $options = get_option('corner_options'); if( $options['sharing_button'] ) { ?>
						<span class="share">
							<a class="facebook" href="javascript: void(window.open('http://www.facebook.com/share.php?u='.concat(encodeURIComponent(location.href)) ));" title="<?php _e('Share to Facebook','corner'); ?>">Facebook</a>
							<a class="plurk" href="javascript: void(window.open('http://www.plurk.com/?qualifier=shares&status=' .concat(encodeURIComponent(location.href)) .concat(' ') .concat('&#40;') .concat(encodeURIComponent(document.title)) .concat('&#41;')));" title="<?php _e('Share to Plurk','corner'); ?>">Plurk</a>
							<a class="twitter" href="javascript: void(window.open('http://twitter.com/home/?status='.concat(encodeURIComponent(document.title)) .concat(' ') .concat(encodeURIComponent(location.href))));" title="<?php _e('Share to Twitter','corner'); ?>">Twitter</a>
							<!-- AddToAny BEGIN -->
							<a class="a2a_dd" href="http://www.addtoany.com/share_save"><?php _e('Share','corner'); ?></a>
							<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
							<!-- AddToAny END -->
						</span>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php comments_template('',true); ?>
			<?php endwhile; ?>
		<?php else: get_template_part('search','failed'); endif; ?>
	</div>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>