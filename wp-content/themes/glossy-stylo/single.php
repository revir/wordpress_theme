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
			
			<div class="postmetadata authorandinfo">
					<strong>版权信息: </strong> 自由转载-非商用-非衍生-保持署名 |  <a href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">Creative Commons BY-NC-ND 3.0</a>
					<strong>原文网址: </strong> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					
					<strong>最后修改时间: </strong> <?php the_modified_time('H:i Y-m-j') ?> 
			</div>
				
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