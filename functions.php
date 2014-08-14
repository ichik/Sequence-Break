<?php
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
if ( ! load_theme_textdomain( 'stag', get_stylesheet_directory() . '/languages' ) ) { load_theme_textdomain( 'stag', get_template_directory() . '/languages' ); }
function stag_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span>', 'stag' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		),
		stag_post_reading_time()
	);
}
function stag_get_google_font_uri() {
	return 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Open+Sans:400italic,700italic,400,700&subset=latin,cyrillic';
}
remove_all_actions( 'do_feed_rss2' );
remove_all_actions( 'do_feed_rss' );
remove_all_actions( 'do_feed_rdf' );
remove_all_actions( 'do_feed_atom' );
add_action('init', 'customRSS');
function customRSS(){
        add_feed('sqncbrk', 'customRSSFunc');
        global $wp_rewrite;
        $wp_rewrite->add_external_rule( 'feed/', '?feed=sqncbrk' );
}
function customRSSFunc(){
        get_template_part('feed', 'sqncbrk');
}
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');
?>