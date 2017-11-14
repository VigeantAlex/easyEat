<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
function ci_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Blog Sidebar', 'ci_theme'),
		'id' => 'blog-widgets',
		'description' => __( 'This sidebar appears only on the blog and posts.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Pages Sidebar', 'ci_theme'),
		'id' => 'page-widgets',
		'description' => __( 'This sidebar appears only on pages.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Location Page Sidebar', 'ci_theme'),
		'id' => 'location-widgets',
		'description' => __( 'This sidebar appears only on the location page template.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Contact Page Sidebar', 'ci_theme'),
		'id' => 'contact-widgets',
		'description' => __( 'This sidebar appears only on the contact page template.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Homepage Testimonial Widget', 'ci_theme'),
		'id' => 'front-row-1',
		'description' => __( 'Widgets here are displayed in the frontpage under the slider. Optimally use the Testimonials widget here.', 'ci_theme'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Homepage Second Row', 'ci_theme'),
		'id' => 'front-row-2',
		'description' => __( 'Widgets here are displayed in the frontpage under the testimonial box (if you have one). The CI Page widget is specially designed for this location.', 'ci_theme'),
		'before_widget' => '<div class="four columns %1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Homepage Third Row', 'ci_theme'),
		'id' => 'front-row-3',
		'description' => __( 'Widgets here are displayed in the frontpage under the first widget row (if you have one). The CI Page widget is specially designed for this location.', 'ci_theme'),
		'before_widget' => '<div class="four columns %1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Header Socials Sidebar', 'ci_theme'),
		'id' => 'header-widgets',
		'description' => sprintf(__( 'The widgets here will appear at the top left of your header. For best appearance only the Socials Ignited widget is allowed here. You can download the Socials Ignited plugin from %s', 'ci_theme'), 'https://wordpress.org/extend/plugins/socials-ignited/'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Column 1', 'ci_theme'),
		'id' => 'footer-widgets-1',
		'description' => __( 'Widgets assigned here will appear on the third column of the footer.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Column 2', 'ci_theme'),
		'id' => 'footer-widgets-2',
		'description' => __( 'Widgets assigned here will appear on the third column of the footer.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Column 3', 'ci_theme'),
		'id' => 'footer-widgets-3',
		'description' => __( 'Widgets assigned here will appear on the third column of the footer.', 'ci_theme'),
		'before_widget' => '<aside class="widget group %1$s %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));


}
endif;
?>