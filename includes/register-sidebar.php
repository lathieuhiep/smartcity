<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function smartcity_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function smartcity_multiple_widget_init(): void {
	smartcity_widget_registration( esc_html__('Sidebar Main', 'smartcity'), 'sidebar-main' );

	smartcity_widget_registration( esc_html__('Sidebar Footer Column 1', 'smartcity'), 'sidebar-footer-column-1' );
	smartcity_widget_registration( esc_html__('Sidebar Footer Column 2', 'smartcity'), 'sidebar-footer-column-2' );
	smartcity_widget_registration( esc_html__('Sidebar Footer Column 3', 'smartcity'), 'sidebar-footer-column-3' );
	smartcity_widget_registration( esc_html__('Sidebar Footer Column 4', 'smartcity'), 'sidebar-footer-column-4' );
}

add_action('widgets_init', 'smartcity_multiple_widget_init');