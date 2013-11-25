<?php
// Sidebar
function corner_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar (Main)', 'corner' ),
		'id' => 'sidebar-main',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar (Without border)', 'corner' ),
		'id' => 'sidebar-without-border',
		'before_widget' => '<li id="%1$s" class="widget noborder %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar (Post)', 'corner' ),
		'id' => 'sidebar-post',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar (Post, Without border)', 'corner' ),
		'id' => 'sidebar-post-without-border',
		'before_widget' => '<li id="%1$s" class="widget noborder %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'corner_widgets_init' );

register_nav_menus( array(
	'main' => __( 'Menu (Main)', 'corner' ),
	'sub' => __( 'Menu (Subscription)', 'corner' ),
	'footer' => __( 'Menu (Footer)', 'corner' ),
) );
// Custom background support
add_custom_background();
define('BACKGROUND_IMAGE', '%s/images/background.jpg');

// Add default posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');

// Thumbnails
add_theme_support('post-thumbnails');

// Custom editor style
add_editor_style('style-editor.css');

// Custom Header
add_custom_image_header('corner_banner_style','corner_banner_admin');
define('HEADER_IMAGE_WIDTH', 700);
define('HEADER_IMAGE_HEIGHT', 200);
define('NO_HEADER_TEXT', true );
function corner_banner_style(){ ?>
	<style type='text/css'>
		#banner{background: url(<?php header_image(); ?>);}
	</style>
<?php }
function corner_banner_admin(){ ?>
	<style type='text/css'>
		#headimg{width: <?php echo HEADER_IMAGE_WIDTH; ?>px;height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;}
	</style>
<?php }

// Script load
wp_register_script('corner-main',get_bloginfo('template_directory') . '/js/main.js',array('jquery'),'1.0');
wp_register_script('corner-comment',get_bloginfo('template_directory') . '/js/comment.js',array('jquery'),'1.0');

// Content width
if ( ! isset( $content_width ) ) $content_width = 660;

// Translation support
load_textdomain('corner', dirname(__FILE__).'/languages/' . get_locale() . '.mo');

// Page navi
function corner_pagenavi() {
	global $wp_query,$wp_rewrite;
	$wp_query->query_vars['paged']>1?$current=$wp_query->query_vars['paged']:$current=1;
	$pagination=array(
		'base'=>@add_query_arg('paged','%#%'),
		'format'=>'',
		'total'=>$wp_query->max_num_pages,
		'mid_size' => 4,
		'type' => 'plain',
		'current'=>$current ,
		'prev_text'=>__('&laquo; Prev','corner'),
		'next_text'=>__('Next &raquo;','corner'));
	echo '<div class="wp-pagenavi">'.paginate_links($pagination).'</div>';
}

function ajax_home(){
	if( isset($_GET['action'])&& $_GET['action'] == 'ajax_home'){
		query_posts("paged=" . $_GET['paged']);
		get_template_part('loop','index');
	die();
	}else{return;}
}
add_action('init','ajax_home');

// Other CSS&JS
function corner_submenu_close(){ ?>
	<style type="text/css">
		#header ul,#header #search .input{width: 630px;}
		#header #search{width: 700px;}
		#header #search,#header #search_button{right: 0;}
		#header #search .input input#s1{width: 550px;}
	</style>
<?php }
function corner_ajax_navi(){ 
	if( is_home() ){ ?>
	<!--[if (gt IE 9)|!(IE)]><!-->
	<script type="text/javascript">
	jQuery(document).ready(function(){home_page_ajax();});
	var al_loading = '<?php _e('Loading...','corner'); ?>';
		al_error = '<?php _e('Error! Sorry, you have to manually refresh the page.','corner'); ?>';
	</script>
	<!--<![endif]-->
<?php }
}
function corner_reply_at(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){replyAction();});
	</script>
<?php }
$options = get_option('corner_options');
if( $options['subscribe_menu'] == false) add_action('wp_head','corner_submenu_close');
if( $options['pagenavi_ajax'] ) add_action('wp_head','corner_ajax_navi');
if( $options['reply_before_at'] ) add_action('wp_head','corner_reply_at');

// Custom comments
if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}

function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
 	<div class="comment-avatar">
	 	<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 40); } ?>
	 	<?php if ($comment->comment_approved == '0') : ?>
	 	<small class="mod"><?php _e('MOD','corner'); ?></small>
	 	<?php endif; ?>
	 	<?php if($comment->comment_author_email == get_the_author_meta('email')) : ?>
	 	<small><?php _e('ADMIN','corner'); ?></small>
	 	<?php endif; ?>
 	</div>
    <div class="comment-meta">
    	<?php if (get_comment_author_url()) : ?>
    		<a id="commentauthor-<?php comment_ID() ?>" href="<?php comment_author_url() ?>" rel="external nofollow" class="author" title="<?php comment_author(); ?>">
    	<?php else : ?>
    		<span id="commentauthor-<?php comment_ID() ?>" class="author" title="<?php comment_author(); ?>">
    	<?php endif; ?>
    		<?php comment_author(); ?>
    	<?php if (get_comment_author_url()) : ?>
    		</a>
    	<?php else : ?>
    		</span>
    	<?php endif; ?>
    	<span class="date"><?php echo get_comment_time(__(' / M jS, Y G:i','corner')); ?></span>
    	<span class="function">
	    	<?php edit_comment_link(__('Edit','corner')); ?>
	    	<a href="javascript:void(0);" class="comment-quote-link" title="<?php _e('Quote','corner'); ?>"><?php _e('Quote','corner'); ?></a>
	    	<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	    	    
    	</span>
    </div>
    <div class="comment-content" id="comment-content-<?php comment_ID() ?>">
	    <?php comment_text(); ?>
    </div>
<?php }

// Custom trackbacks/pingbacks
function custom_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
 <li class="trackback" id="comment-<?php comment_ID() ?>">
 	<div class="trackback_meta alignright">
 	<?php echo get_comment_time(__('M jS, Y G:i','corner')) ?>
 	<?php edit_comment_link(__('Edit','corner'), '', ''); ?>
 	</div>
 	<div class="trackback_title">
 	<a href="<?php comment_author_url() ?>"><?php comment_author(); ?></a>
 	</div>
 </li>
<?php }
if ( file_exists( TEMPLATEPATH. '/admin/admin.php' ) ) {
	require_once( TEMPLATEPATH. '/admin/admin.php' );
	$cornerOpt = new cornerOpt();
}
?>