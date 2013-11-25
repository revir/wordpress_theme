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
				<div class="clearfix"></div>
			</div>
			
			<?php if ( comments_open() ) comments_template('',true); ?>
			<?php endwhile; ?>
		<?php else: get_template_part('search','failed'); endif; ?>
	</div>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>