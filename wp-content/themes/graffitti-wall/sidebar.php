<div id="sidebar_left">
<ul>

<li>
<img class="userimage" src="<?php bloginfo('stylesheet_directory'); ?>/images/image.jpg" alt="image" border="0"/>
</li>

<li>
<div id="d_sidebar">
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
<?php endif; ?>
</div>
</li>
<ul>

</div>