		<?php if (have_posts()): while (have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="title">
					<?php $options = get_option('corner_options'); if ( ! isset( $options['list_date'] ) || $options['list_date'] ) { ?><span class="date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_time(__('M jS, Y','corner')); ?></a></span><?php } ?>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<span class="comments">
						<?php if(!comments_open()) { echo '<a>X</a>'; } else { comments_popup_link('0','1','%'); }?>
					</span>
				</div>
				<div class="entry">
					<?php if ( ! isset( $options['list_layout'] ) || $options['list_layout'] == 'full') { the_content(__('Read More &raquo;','corner')); } elseif ( $options['list_layout'] == 'thumbnail' ) { if ( has_post_thumbnail() ) { the_post_thumbnail( array(150,150),array('class' => 'alignleft') ); } the_excerpt(); } ?>
					<?php if ($options['list_layout'] != 'title' ) wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'corner' ), 'after' => '</div>' ) ); ?>
				</div>
			</div>
			<?php endwhile; ?>
		<?php else: get_template_part('search','failed'); endif; ?>
		<?php if( $wp_query->max_num_pages > 1 ) { 
			if( ! isset( $options['pagenavi_type'] ) || $options['pagenavi_type'] == 'builtin' ) {
				corner_pagenavi();
			} elseif(function_exists('wp_pagenavi') && $options['pagenavi_type'] == 'plugin') {
				wp_pagenavi();
			} else { ?>
				<div class="wp-pagenavi">
					<span class="newer"><?php previous_posts_link(__('&laquo; Newer', 'corner')); ?></span>
					<span class="older"><?php next_posts_link(__('Older &raquo;', 'corner')); ?></span>
				</div>
			<?php }
		} ?>