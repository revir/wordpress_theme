<?php get_header(); ?>
<?php get_sidebar(); ?>
	
	<div id="content">
	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>	
			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>
				
				<div class="entry">
					<?php the_excerpt() ?>
				</div>
				
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
				Filed under <?php the_category(', ') ?>.
		
				<p class="postmetadata">Filed under: <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link('Edit','','<strong>|</strong>'); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
	<div class="postbottom">&nbsp;</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>
	
	<?php else : ?>

		<h2>Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
		
	</div>
	
<?php get_footer(); ?>