<?php get_header(); ?>
<?php get_sidebar(); ?>
	
<div id="content">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
				
		<div class="post" id="post-<?php the_ID(); ?>">
		
		
		
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php edit_post_link('(edit)'); ?>
		

			
				<div class="clear">&nbsp;</div>
			<div class="entry">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			Filed under <?php the_category(', ') ?>.
			<p class="postmetadata"> <?php the_time('F jS, Y') ?>  |  <?php comments_popup_link('No reply', '1 replies', '% replies'); ?></p>
			
			
  </div>
	
	<div class="postbottom">&nbsp;</div>
	
		<?php endwhile; ?>

		<div class="navigation">
			<?php next_posts_link('&laquo; Older Entries') ?>  <?php previous_posts_link('Newer Entries &raquo;') ?>
	</div>
		
		<?php else : ?>

		<h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
	
</div>

<?php get_footer(); ?>
