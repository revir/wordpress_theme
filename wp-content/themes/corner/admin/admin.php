<?php
class cornerOpt {
	private $sections;
	
	private $defaults = array(
		// Header
		'header_tagline' => '0',
		'title_font_size' => '40',
		'use_banner' => '0',
		'random_banner' => '0',
		'subscribe_menu' => '0',
		// Reading
		'list_layout' => 'full',
		'list_date' => '1',
		'pagenavi_type' => 'builtin',
		'pagenavi_ajax' => '0',
		'sharing_button' => '0',
		// Comment
		'trackback_options' => '1',
		'reply_before_at' => '0',
		// Footer
		'footer_menu_enable' => '0',
		'footer_content' => '',
	);
	
	private $checkboxes;
	
	public function __construct() {
		$this->checkboxes = array();
		
		$this->sections['header'] = __('Header','corner');
		$this->sections['reading'] = __('Reading','corner');
		$this->sections['comment'] = __('Comments','corner');
		$this->sections['footer'] = __('Footer','corner');
		$this->sections['manual'] = __('Manual','corner');
		
		if ( ! get_option('corner_options') )
			update_option('corner_options', $this->defaults);
		
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
	}
	
	public function add_pages() {
		$admin_page = add_theme_page( __('Theme Options','corner'), __('Theme Options','corner'), 'edit_theme_options', 'corner-settings', array( &$this, 'display_page' ) );
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
	}
		
	public function create_setting( $args = array() ) {
		$defaults = array(
			'id'		=> '',
			'title'		=> '',
			'desc'		=> '',
			'type'		=> 'text',
			'section'	=> 'general',
			'choices'	=> array(),
			'class'		=> '',
			'before'	=> '',
			'after'		=> '',
			'maxlength'	=> '',
		);
		
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'		=> $type,
			'id'		=> $id,
			'desc'		=> $desc,
			'choices'	=> $choices,
			'label_for'	=> $id,
			'class'		=> $class,
			'before'	=> $before,
			'after'		=> $after,
			'maxlength'	=> $maxlength
		);
		
		add_settings_field( $id, $title, array( $this, 'display_settings' ), 'corner-settings', $section, $field_args );
		
		if ( $type = 'checkbox' )
			$this->checkboxes[] = $id;
	}
	
	public function display_page() { ?>
		<div class="wrap">
			<div class="header">
				<div id="corner_switch">
					<h2><?php _e('Theme Options','corner'); ?></h2>
					<?php
					foreach ( $this->sections as $slug => $title )
						echo '<a id="corner_' . $slug . '">' . $title . '</a>';
					?>
				</div>
			</div>
			<form action="options.php" method="post" id="corner" enctype="multipart/form-data">
				<?php
				if ( isset( $_GET['settings-updated'] ) )
					echo '<div class="updated fade"><p><strong>'.__('&radic; Saved','corner').'</strong></p></div>';
				?>
				<?php
				settings_fields('corner_options');
				do_settings_sections( $_GET['page'] );
				?>
				<input type="submit" name="corner_options[submit]" class="button-primary" value="<?php _e('Save Changes', 'corner'); ?>" />
				<input type="submit" name="corner_options[reset]" class="button-secondary" onclick="if(confirm('<?php _e('All current settings will be reset to defaults. Are you sure?','corner'); ?>')) return true; else return false;" value="<?php _e('Reset to Deafults', 'corner'); ?>" />
			</form>
		</div>
	<?php }
	
	public function display_section() {
	}
	
	public function manual_section() { ?>
		<table id="corner_manual" class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Menu','corner'); ?></th>
				<td>
					<?php _e('How to display "Home Page" link as an icon?','corner'); ?><br />
					<?php _e('1. Go to "Appearance" &rarr; "Menus".','corner'); ?><br />
					<?php _e('2. Click "Screen Options" in upper-right corner.','corner'); ?><br />
					<?php _e('3. Check "Show advanced menu properties" &rarr; "CSS Classes".','corner'); ?><br />
					<?php _e('4. Filled in the CSS Classes of home page with "home".','corner'); ?><br />
					<span style="color: #777;"><?php _e('&lowast; Too many menu items may cause layout to break.','corner'); ?><br />
					<?php _e('&lowast; Menu items won\'t be displayed if Javascript is disabled.','corner'); ?></span>
				</td>
			</tr>
		</table>
	<?php }
	
	public function display_settings( $args = array() ) {
		extract( $args );
		
		$options = get_option('corner_options');
		
		if ( $class != '' )
			echo '<div class="' . $class . '">';
		
		if ( $desc != '' )
			echo $desc . '<br />';
		
		if ( $before != '' )
			echo '<label for="' . $id . '">' . $before . '</label>';
		
		switch ( $type ) {
			case 'checkbox':
				echo '<input type="checkbox" id="' . $id . '" name="corner_options[' . $id . ']" value="1"'.checked( $options[$id], 1, false ) . ' />';
				
				break;
			
			case 'select':
				echo '<select name="corner_options[' . $id . ']">';
				
				foreach ( $choices as $value => $label )
					echo '<option value="' . $value . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
					
				echo '</select>';
				
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input type="radio" name="corner_options[' . $id . ']" id="' . $id . $i . '" value="' . $value . '"'. checked( $options[$id], $value, false ) . ' /><label for="' . $id . '">' . $label . '</label>';
					if( $i < count($options) - 1 )
						echo '<br />';
					$i++;
				}
				
				break;
			
			case 'textarea':
				echo '<textarea id="' . $id . '" name="corner_options[' . $id . ']" cols="95%" rows="10">' . $options[$id] . '</textarea>'; 
				
				break;
				
			case 'text':
			default:
				echo '<input type="text" id="' . $id . '" name="corner_options[' . $id . ']" value="' . $options[$id] . '" maxlength="' . $maxlength . '" />';
				
				break;
		}
		
		if ( $after != '' )
			echo '<label for="' . $id . '">' . $after . '</label>';
			
		if ( $class != '' )
			echo '</div>';
	}
	
	public function styles() {
		wp_enqueue_style('cornerAdminCSS', get_template_directory_uri().'/admin/admin.css');
	}
	
	public function scripts() {
		wp_enqueue_script('cornerAdminJS', get_template_directory_uri().'/admin/admin.js');
	}
	
	public function register_settings() {
		register_setting( 'corner_options', 'corner_options', array( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title )
			if ( $slug == 'manual' )
				add_settings_section( $slug, '', array( &$this, 'manual_section' ), 'corner-settings' );
			else
				add_settings_section( $slug, '', array( &$this, 'display_section' ), 'corner-settings' );
		
		// Header
		$this->create_setting( array (
			'id'		=> 'header_tagline',
			'title'		=> __('Tagline', 'corner'),
			'desc'		=> __('Display the blog tagline.', 'corner'),
			'type'		=> 'checkbox',
			'section'	=> 'header',
			'after'		=> __('Enable', 'corner')
		) );
		
		$this->create_setting( array (
			'id'		=> 'title_font_size',
			'title'		=> __('Font Size', 'corner'),
			'desc'		=> __('Adjust the font size of the blog title. (Default is 40 pixels)', 'corner'),
			'type'		=> 'text',
			'section'	=> 'header',
			'after'		=> __(' px (pixels)','corner'),
			'maxlength'	=> '2'
		) );
		
		$this->create_setting( array (
			'id'		=> 'use_banner',
			'title'		=> __('Banner', 'corner'),
			'desc'		=> __('Display the banner. The size of banner is 700x200 pixels. (You can customize your own banner in "Appearance" &rarr; "Header".)','corner').'<br />'.
			__('If you enabled "Random Banner", you have to put your banner in "/headers" folder. When pages refreshed, photos will be randomly displayed.', 'corner'),
			'type'		=> 'checkbox',
			'section'	=> 'header',
			'after'		=> __('Enable', 'corner'),
		) );
		
		$this->create_setting( array (
			'id'		=> 'random_banner',
			'type'		=> 'checkbox',
			'section'	=> 'header',
			'class'		=> 'child',
			'after'		=> __('Enable Random Banner', 'corner'),
		) );
		
		$this->create_setting( array (
			'id'		=> 'subscribe_menu',
			'title'		=> __('Subscription Menu', 'corner'),
			'desc'		=> __('Show the subscription menu on the rightmost side of the menu. (You can customize your own menu in "Appearance" &rarr; "Menus".)','corner').'<br /><span style="color: #777;">'.
			__('&lowast; Menu items won\'t be displayed if Javascript is disabled.', 'corner').'</span>',
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'header'
		) );
		
		// Reading
		$this->create_setting( array (
			'id'		=> 'list_layout',
			'title'		=> __('Layout', 'corner'),
			'desc'		=> __('Select the layout of home page and archives page.', 'corner'),
			'type'		=> 'select',
			'section'	=> 'reading',
			'choices'	=> array(
				'full'		=> __('Full','corner'),
				'thumbnail'	=> __('Excerpt & Thumbnails','corner'),
				'title'		=> __('Only Title','corner')
			)
		) );
		
		$this->create_setting( array (
			'id'		=> 'list_date',
			'title'		=> '',
			'desc'		=> __('Display the date of posts in home page and archive pages.', 'corner'),
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'reading'
		) );
		
		$this->create_setting( array (
			'id'		=> 'pagenavi_type',
			'title'		=> __('Page Navi','corner'),
			'desc'		=> __('Select the way of navigation.','corner').'<br /><span style="color: #777;">'.
			__('&lowast; If you select "Plugin", you should install the plugin "WP-PageNavi" first.', 'corner').'</span>',
			'type'		=> 'select',
			'section'	=> 'reading',
			'choices'	=> array(
				'builtin'		=> __('Built in theme','corner'),
				'plugin'	=> __('Plugin (WP-PageNavi)','corner'),
				'system'		=> __('WordPress Default','corner')
			)
		) );
		
		$this->create_setting( array (
			'id'		=> 'pagenavi_ajax',
			'title'		=> '',
			'desc'		=> __('You can also enable AJAX, users can turn to other pages without refreshing.', 'corner').'<br /><span style="color: #777;">'.
			__('&lowast; Incompatible with Internet Explorer (IE) 8 or below.','corner').'</span>',
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'reading'
		) );
		
		$this->create_setting( array (
			'id'		=> 'sharing_button',
			'title'		=> __('Sharing Button','corner'),
			'desc'		=> __('Display a sharing button in your articles. (Powered by AddToAny)', 'corner'),
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'reading'
		) );
		
		// Comments
		$this->create_setting( array (
			'id'		=> 'trackback_options',
			'title'		=> __('Trackback','corner'),
			'desc'		=> __('Show the trackback from other sites.', 'corner'),
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'comment'
		) );
		
		$this->create_setting( array (
			'id'		=> 'reply_before_at',
			'title'		=> __('Reply','corner'),
			'desc'		=> __('Add "@username" before every reply.', 'corner'),
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'comment'
		) );
		
		// Footer
		$this->create_setting( array (
			'id'		=> 'footer_menu_enable',
			'title'		=> __('Footer Menu','corner'),
			'desc'		=> __('Show the menu in footer.', 'corner'),
			'type'		=> 'checkbox',
			'after'		=> __('Enable', 'corner'),
			'section'	=> 'footer'
		) );
		
		$this->create_setting( array (
			'id'		=> 'footer_content',
			'title'		=> __('Footer Information','corner'),
			'desc'		=> __('Show the custom information in footer. Default is "Copyright &copy; 2011 Your Site". (HTML is avalible)', 'corner'),
			'type'		=> 'textarea',
			'section'	=> 'footer'
		) );
	}
	
	public function validate_settings( $input ) {
		
		$options = get_option('corner_options');
		$valid_input = $options;
		
		$submit = ( ! empty( $input['submit'] ) ? true : false );
		$reset = ( ! empty( $input['reset'] ) ? true : false );
		
		if ( $submit ) {
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					$input[$id] = '0';
			}
			
			$valid_input = $input;
			
		} elseif ( $reset ) {
			$valid_input = $this->defaults;
		}
				
		return $valid_input;
	}
}
?>