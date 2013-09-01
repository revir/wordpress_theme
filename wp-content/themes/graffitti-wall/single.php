<?php get_header(); ?>
<?php get_sidebar(); ?>
	
	<div id="content">			
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">

		<div class="clear"></div>
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<small><?php edit_post_link('(edit)'); ?></small>
	
			<div class="entry">
				<?php the_content('<p>Continue reading &raquo;</p>'); ?>
	

			</div>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			Filed under <?php the_category(', ') ?>.
			<p class="postmetadata"> <?php the_time('F jS, Y') ?>  </p>
			</div>
		<div class="postbottom">&nbsp;</div>
		<?php comments_template(); ?>

	<?php endwhile; else: ?>
	
	<p>Sorry, no posts matched your criteria.</p>
	
	<?php endif; ?>
	
	</div>

<?php get_footer(); ?>
