<?php
get_header();
?>

	<div id="content" class="narrowcolumn" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		
		
				<div id="postbg">
				<div id="postheader"></div>
				

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<p class='post_timestamp'>本文最后发表时间: <?php the_modified_time('H:i Y-m-j') ?> </p>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<div class="pages"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>标签: ', ', ', '</p>'); ?>


			</div>
			
			<p class="postmeltadata traceandcomment">

						<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.					 
			</p>
				
			</div>
					<div id="postfooter"></div>
					
			<div class="navigation">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
				<div class="clear"></div>
			</div>
		</div>
		
		

	<?php comments_template(); ?>
	</div>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	
<?php get_sidebar(); ?>

<?php get_footer(); ?>