<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">.
 *
 * @package Stag_Customizer
 * @subpackage Ink
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/sequencebreak" />
<?php wp_head(); ?>
<?php
#twitter cards hack
if(is_single() || is_page()) {
 $twitter_title  = get_the_title();
$twitter_desc   = get_the_excerpt();
   $twitter_thumbs = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), full );
    $twitter_thumb  = $twitter_thumbs[0];
      if(!$twitter_thumb) {
      $twitter_thumb = 'http://www.gravatar.com/avatar/8eb9ee80d39f13cbbad56da88ef3a6ee?rating=PG&size=75';
    }
  $twitter_name   = str_replace('@', '', get_the_author_meta('twitter'));
  } else {
	$twitter_thumb = "http://sequencebreak.ru/wp-content/uploads/2014/05/sequencebreak-cover.png";
	$twitter_desc = "Персональный блог @ichikumer о видеоиграх жанра «метроидвания»";
	$twitter_title = "Sequence Break";
	}
?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sqncbrk">
<meta name="twitter:title" content="<?php echo $twitter_title; ?>">
<meta name="twitter:creator" content="@ichikumer">
<meta name="twitter:image:src" content="<?php echo $twitter_thumb; ?>">
<meta name="twitter:domain" content="SequenceBreak.ru">
<meta name="twitter:description" content="<?php echo $twitter_desc; ?>">
</head>
<body <?php body_class(); ?> data-layout="<?php echo esc_attr( stag_site_layout() ); ?>">

<nav class="site-nav">
	<div class="site-nav--scrollable-container">
		<i class="stag-icon icon-bars"></i>
		<?php if( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="navigation main-navigation site-nav__section" role="navigation">
			<h4 class="widgettitle"><?php _e( 'Menu', 'stag' ); ?></h4>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu', 'container' => false, 'fallback_cb' => false ) ); ?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-drawer' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-drawer' ); ?>
		<?php endif; ?>
	</div>
</nav>
<div class="site-nav-overlay"></div>

<div id="page" class="hfeed site">

	<div id="content" class="site-content">

		<header id="masthead" class="site-header">

			<div class="site-branding">
				<?php if ( stag_get_logo()->has_logo() ) : ?>
					<?php if (is_home()) : ?>
						<img class="custom-logo" src="/blank.png" alt="Sequence Break">
					<?php else: ?>
						<a class="custom-logo" title="Sequence Break" href="<?php echo esc_url( home_url( '/' ) ); ?>"></a>
					<?php endif; ?>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>

				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>

			<a href="#" id="site-navigation-toggle" class="site-navigation-toggle"><i class="stag-icon icon-bars"></i></a>

			<?php if ( ! is_author() && ( is_archive() || is_search() ) ) : ?>
			<div class="archive-header">
				<h3 class="archive-header__title"><?php echo stag_archive_title(); ?></h3>
			</div>
			<?php endif; ?>

		</header><!-- #masthead -->
