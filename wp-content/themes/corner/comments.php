<div id="comments">
	<div class="comment_inner">
		<h3 class="title"><?php _e('Comments','corner'); ?></h3>
		<?php if ( post_password_required() ) : ?>
						<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'corner' ); ?></p>
					</div></div>
		<?php return; endif; ?>
		
		<?php if ( have_comments() ) : ?>
					<ol class="commentlist">
						<?php wp_list_comments(array('type' => 'comment' , 'callback' => 'custom_comments')); ?>
					</ol>
		<?php
			if (get_option('page_comments')) {
				$comment_pages = paginate_comments_links(array('prev_text' => __('&lt; Prev','corner'), 'next_text' => __('Next &gt;','corner'),'echo' => 0));
				if ($comment_pages) {
		?>
			<div class="pagenavi">
				<?php echo $comment_pages; ?>
			</div>
		<?php
				}
			}
		?>
		<?php else : if ( ! comments_open() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'corner' ); ?></p>
		<?php endif; ?>
		
		<?php endif; ?>
		
		<?php comment_form(array('title_reply' => '')); ?>
	</div>
	<?php $optons = get_option('corner_options'); if ( ! isset( $options['trackback_options'] ) || $options['trackback_options'] ) : ?>
		<?php if( !empty($comments_by_type['pings']) ): ?>
			<div class="comment_inner">
				<h3 class="title"><?php _e('Trackbacks','corner'); ?></h3>
				<ol class="trackbacklist">
					<?php wp_list_comments(array('type' => 'pings' , 'callback' => 'custom_pings')); ?>
				</ol>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
</div>