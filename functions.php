<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

	// Use a child theme instead of placing custom functions here
	// http://codex.wordpress.org/Child_Themes


/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */

	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	load_template( get_template_directory() . '/option-tree/ot-loader.php' );


/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */

if ( ! function_exists( 'alx_load' ) ) {

	function alx_load() {
		// Load theme languages
		load_theme_textdomain( 'hueman', get_template_directory().'/languages' );

		// Load theme options and meta boxes
		load_template( get_template_directory() . '/functions/theme-options.php' );
		load_template( get_template_directory() . '/functions/meta-boxes.php' );

		// Load custom widgets
		load_template( get_template_directory() . '/functions/widgets/alx-tabs.php' );
		load_template( get_template_directory() . '/functions/widgets/alx-video.php' );
		load_template( get_template_directory() . '/functions/widgets/alx-posts.php' );

		// Load custom shortcodes
		load_template( get_template_directory() . '/functions/shortcodes.php' );

		// Load dynamic styles
		load_template( get_template_directory() . '/functions/dynamic-styles.php' );

		// Load TGM plugin activation
		load_template( get_template_directory() . '/functions/class-tgm-plugin-activation.php' );
	}

}
add_action( 'after_setup_theme', 'alx_load' );


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */

	// Content width
	if ( !isset( $content_width ) ) { $content_width = 720; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'alx_setup' ) ) {

	function alx_setup() {
		// Enable title tag
		add_theme_support( 'title-tag' );

		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );

		// Enable post format support
		add_theme_support( 'post-formats', array( 'audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );

		// Thumbnail sizes
		add_image_size( 'thumb-small', 160, 160, true );
		add_image_size( 'thumb-standard', 320, 320, true );
		add_image_size( 'thumb-medium', 520, 245, true );
		add_image_size( 'thumb-large', 720, 340, true );

		// Custom menu areas
		register_nav_menus( array(
			'topbar' => 'Topbar',
			'header' => 'Header',
			'footer' => 'Footer',
		) );
	}

}
add_action( 'after_setup_theme', 'alx_setup' );


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebars' ) ) {

	function alx_sidebars()	{
		register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Secondary','id' => 'secondary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		if ( ot_get_option('header-ads') == 'on' ) { register_sidebar(array( 'name' => 'Header Ads','id' => 'header-ads', 'description' => "Header ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-ads') == 'on' ) { register_sidebar(array( 'name' => 'Footer Ads','id' => 'footer-ads', 'description' => "Footer ads area", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }

		register_sidebar( array(
			'name'          => 'Top Title Ad Widget',
			'id'            => 'top-title-widget',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		) );

	}

}
add_action( 'widgets_init', 'alx_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */
if ( ! function_exists( 'alx_scripts' ) ) {

	function alx_scripts() {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true );
		if ( is_singular() ) { wp_enqueue_script( 'sharrre', get_template_directory_uri() . '/js/jquery.sharrre.min.js', array( 'jquery' ),'', true ); }
		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}

}
add_action( 'wp_enqueue_scripts', 'alx_scripts' );


/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'alx_styles' ) ) {

	function alx_styles() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		if ( ot_get_option('custom') == 'on' ) { wp_enqueue_style( 'custom', get_template_directory_uri().'/custom.css' ); }
		wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'alx_styles' );


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'alx_custom_sidebars' ) ) {

	function alx_custom_sidebars() {
		if ( !ot_get_option('sidebar-areas') =='' ) {

			$sidebars = ot_get_option('sidebar-areas', array());

			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
						register_sidebar(array('name' => ''.esc_attr( $sidebar['title'] ).'','id' => ''.esc_attr( strtolower($sidebar['id']) ).'','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
					}
				}
			}
		}
	}

}
add_action( 'widgets_init', 'alx_custom_sidebars' );


/* ------------------------------------------------------------------------- *
 *  Template functions
/* ------------------------------------------------------------------------- */

/*  Layout class
/* ------------------------------------ */
if ( ! function_exists( 'alx_layout_class' ) ) {

	function alx_layout_class() {
		// Default layout
		$layout = 'col-3cm';
		$default = 'col-3cm';

		// Check for page/post specific layout
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_layout',true);
			// Get if set and not set to inherit
			if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
			// Else check for page-global / single-global
			elseif ( is_single() && ( ot_get_option('layout-single') !='inherit' ) ) $layout = ot_get_option('layout-single',''.$default.'');
			elseif ( is_page() && ( ot_get_option('layout-page') !='inherit' ) ) $layout = ot_get_option('layout-page',''.$default.'');
			// Else get global option
			else $layout = ot_get_option('layout-global',''.$default.'');
		}

		// Set layout based on page
		elseif ( is_home() && ( ot_get_option('layout-home') !='inherit' ) ) $layout = ot_get_option('layout-home',''.$default.'');
		elseif ( is_category() && ( ot_get_option('layout-archive-category') !='inherit' ) ) $layout = ot_get_option('layout-archive-category',''.$default.'');
		elseif ( is_archive() && ( ot_get_option('layout-archive') !='inherit' ) ) $layout = ot_get_option('layout-archive',''.$default.'');
		elseif ( is_search() && ( ot_get_option('layout-search') !='inherit' ) ) $layout = ot_get_option('layout-search',''.$default.'');
		elseif ( is_404() && ( ot_get_option('layout-404') !='inherit' ) ) $layout = ot_get_option('layout-404',''.$default.'');

		// Global option
		else $layout = ot_get_option('layout-global',''.$default.'');

		// Return layout class
		return $layout;
	}

}


/*  Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebar_primary' ) ) {

	function alx_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Set sidebar based on page
		if ( is_home() && ot_get_option('s1-home') ) $sidebar = ot_get_option('s1-home');
		if ( is_single() && ot_get_option('s1-single') ) $sidebar = ot_get_option('s1-single');
		if ( is_archive() && ot_get_option('s1-archive') ) $sidebar = ot_get_option('s1-archive');
		if ( is_category() && ot_get_option('s1-archive-category') ) $sidebar = ot_get_option('s1-archive-category');
		if ( is_search() && ot_get_option('s1-search') ) $sidebar = ot_get_option('s1-search');
		if ( is_404() && ot_get_option('s1-404') ) $sidebar = ot_get_option('s1-404');
		if ( is_page() && ot_get_option('s1-page') ) $sidebar = ot_get_option('s1-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_primary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}

}


/*  Dynamic sidebar secondary
/* ------------------------------------ */
if ( ! function_exists( 'alx_sidebar_secondary' ) ) {

	function alx_sidebar_secondary() {
		// Default sidebar
		$sidebar = 'secondary';

		// Set sidebar based on page
		if ( is_home() && ot_get_option('s2-home') ) $sidebar = ot_get_option('s2-home');
		if ( is_single() && ot_get_option('s2-single') ) $sidebar = ot_get_option('s2-single');
		if ( is_archive() && ot_get_option('s2-archive') ) $sidebar = ot_get_option('s2-archive');
		if ( is_category() && ot_get_option('s2-archive-category') ) $sidebar = ot_get_option('s2-archive-category');
		if ( is_search() && ot_get_option('s2-search') ) $sidebar = ot_get_option('s2-search');
		if ( is_404() && ot_get_option('s2-404') ) $sidebar = ot_get_option('s2-404');
		if ( is_page() && ot_get_option('s2-page') ) $sidebar = ot_get_option('s2-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_secondary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}

}


/*  Social links
/* ------------------------------------ */
if ( ! function_exists( 'alx_social_links' ) ) {

	function alx_social_links() {
		if ( !ot_get_option('social-links') =='' ) {
			$links = ot_get_option('social-links', array());
			if ( !empty( $links ) ) {
				echo '<ul class="social-links">';
				foreach( $links as $item ) {

					// Build each separate html-section only if set
					if ( isset($item['title']) && !empty($item['title']) )
						{ $title = 'title="' .esc_attr( $item['title'] ). '"'; } else $title = '';
					if ( isset($item['social-link']) && !empty($item['social-link']) )
						{ $link = 'href="' .esc_attr( $item['social-link'] ). '"'; } else $link = '';
					if ( isset($item['social-target']) && !empty($item['social-target']) )
						{ $target = 'target="' .$item['social-target']. '"'; } else $target = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) )
						{ $icon = 'class="fa ' .esc_attr( $item['social-icon'] ). '"'; } else $icon = '';
					if ( isset($item['social-color']) && !empty($item['social-color']) )
						{ $color = 'style="color: ' .$item['social-color']. ';"'; } else $color = '';

					// Put them together
					if ( isset($item['title']) && !empty($item['title']) && isset($item['social-icon']) && !empty($item['social-icon']) && ($item['social-icon'] !='fa-') ) {
						echo '<li><a rel="nofollow" class="social-tooltip" '.$title.' '.$link.' '.$target.'><i '.$icon.' '.$color.'></i></a></li>';
					}
				}
				echo '</ul>';
			}
		}
	}

}


/*  Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'alx_site_title' ) ) {

	function alx_site_title() {

		// Text or image?
		if ( ot_get_option('custom-logo') ) {
			$logo = '<img src="'.ot_get_option('custom-logo').'" alt="'.get_bloginfo('name').'">';
		} else {
			$logo = get_bloginfo('name');
		}

		$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

		if ( is_front_page() || is_home() ) {
			$sitename = '<h1 class="site-title">'.$link.'</h1>'."\n";
		} else {
			$sitename = '<p class="site-title">'.$link.'</p>'."\n";
		}

		return $sitename;
	}

}


/*  Page title
/* ------------------------------------ */
if ( ! function_exists( 'alx_page_title' ) ) {

	function alx_page_title() {
		global $post;

		$heading = esc_attr( get_post_meta($post->ID,'_heading',true) );
		$subheading = esc_attr( get_post_meta($post->ID,'_subheading',true) );
		$title = $heading?$heading:the_title();
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}

}


/*  Blog title
/* ------------------------------------ */
if ( ! function_exists( 'alx_blog_title' ) ) {

	function alx_blog_title() {
		global $post;
		$heading = esc_attr( ot_get_option('blog-heading') );
		$subheading = esc_attr( ot_get_option('blog-subheading') );
		if($heading) {
			$title = $heading;
		} else {
			$title = get_bloginfo('name');
		}
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}

}


/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'alx_related_posts' ) ) {

	function alx_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 3
		);
		// Related by categories
		if ( ot_get_option('related-posts') == 'categories' ) {

			$cats = get_post_meta($post->ID, 'related-cat', true);

			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( ot_get_option('related-posts') == 'tags' ) {

			$tags = get_post_meta($post->ID, 'related-tag', true);

			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}

		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}

}


/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_images' ) ) {

	function alx_post_images( $args=array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}

}


/*  Get featured post ids
/* ------------------------------------ */
if ( ! function_exists( 'alx_get_featured_post_ids' ) ) {

	function alx_get_featured_post_ids() {
		$args = array(
			'category'		=> ot_get_option('featured-category'),
			'numberposts'	=> ot_get_option('featured-posts-count')
		);
		$posts = get_posts($args);
		if ( !$posts ) return false;
		foreach ( $posts as $post )
			$ids[] = $post->ID;
		return $ids;
	}

}


/* ------------------------------------------------------------------------- *
 *  Admin panel functions
/* ------------------------------------------------------------------------- */

/*  Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'alx_post_formats_script' ) ) {

	function alx_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( !in_array($hook, array('post.php','post-new.php')) )
			return;
		wp_enqueue_script('post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array( 'jquery' ));
	}

}
add_action( 'admin_enqueue_scripts', 'alx_post_formats_script');


/* ------------------------------------------------------------------------- *
 *  Filters
/* ------------------------------------------------------------------------- */

/*  Body class
/* ------------------------------------ */
if ( ! function_exists( 'alx_body_class' ) ) {

	function alx_body_class( $classes ) {
		$classes[] = alx_layout_class();
		if ( ot_get_option( 'boxed' ) != 'on' ) { $classes[] = 'full-width'; }
		if ( ot_get_option( 'boxed' ) == 'on' ) { $classes[] = 'boxed'; }
		if ( has_nav_menu('topbar') ) {	$classes[] = 'topbar-enabled'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's1' ) { $classes[] = 'mobile-sidebar-hide-s1'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's2' ) { $classes[] = 'mobile-sidebar-hide-s2'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's1-s2' ) { $classes[] = 'mobile-sidebar-hide'; }
		return $classes;
	}

}
add_filter( 'body_class', 'alx_body_class' );


/*  Custom rss feed
/* ------------------------------------ */
if ( ! function_exists( 'alx_feed_link' ) ) {

	function alx_feed_link( $output, $feed ) {
		// Do not redirect comments feed
		if ( strpos( $output, 'comments' ) )
			return $output;
		// Return feed url
		return esc_attr( ot_get_option('rss-feed',$output) );
	}

}
add_filter( 'feed_link', 'alx_feed_link', 10, 2 );


/*  Custom favicon
/* ------------------------------------ */
if ( ! function_exists( 'alx_favicon' ) ) {

	function alx_favicon() {
		if ( ot_get_option('favicon') ) {
			echo '<link rel="shortcut icon" href="'.ot_get_option('favicon').'" />'."\n";
		}
	}

}
add_filter( 'wp_head', 'alx_favicon' );


/*  Excerpt ending
/* ------------------------------------ */
if ( ! function_exists( 'alx_excerpt_more' ) ) {

	function alx_excerpt_more( $more ) {
		return '&#46;&#46;&#46;';
	}

}
add_filter( 'excerpt_more', 'alx_excerpt_more' );


/*  Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'alx_excerpt_length' ) ) {

	function alx_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}

}
add_filter( 'excerpt_length', 'alx_excerpt_length', 999 );


/*  Add wmode transparent to media embeds
/* ------------------------------------ */
if ( ! function_exists( 'alx_embed_wmode_transparent' ) ) {

	function alx_embed_wmode_transparent( $html, $url, $attr ) {
		if ( strpos( $html, "<embed src=" ) !== false )
		   { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
		elseif ( strpos ( $html, 'feature=oembed' ) !== false )
		   { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
		else
		   { return $html; }
	}

}
add_filter( 'embed_oembed_html', 'alx_embed_wmode_transparent', 10, 3 );


/*  Add responsive container to embeds
/* ------------------------------------ */
if ( ! function_exists( 'alx_embed_html' ) ) {

	function alx_embed_html( $html, $url ) {

		$pattern    = '/^https?:\/\/(www\.)?twitter\.com/';
		$is_twitter = preg_match( $pattern, $url );

		if ( 1 === $is_twitter ) {
			return $html;
		}

		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );


/*  Add responsive container to jetpack embeds
/* ------------------------------------ */
if ( ! function_exists( 'alx_embed_html_jp' ) ) {

	function alx_embed_html_jp( $html ) {
		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'video_embed_html', 'alx_embed_html_jp' );


/*  Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'alx_thumbnail_upscale' ) ) {

	function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}

}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );


/*  Add shortcode support to text widget
/* ------------------------------------ */
add_filter( 'widget_text', 'do_shortcode' );


/*  Browser detection body_class() output
/* ------------------------------------ */
if ( ! function_exists( 'alx_browser_body_class' ) ) {

	function alx_browser_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) {
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$browser = substr( "$browser", 25, 8);
			if ($browser == "MSIE 7.0"  ) {
				$classes[] = 'ie7';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 6.0" ) {
				$classes[] = 'ie6';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 8.0" ) {
				$classes[] = 'ie8';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 9.0" ) {
				$classes[] = 'ie9';
				$classes[] = 'ie';
			} else {
				$classes[] = 'ie';
			}
		}
		else $classes[] = 'unknown';

		if( $is_iphone ) $classes[] = 'iphone';

		return $classes;
	}

}
add_filter( 'body_class', 'alx_browser_body_class' );


/* ------------------------------------------------------------------------- *
 *  Actions
/* ------------------------------------------------------------------------- */

/*  Include or exclude featured articles in loop
/* ------------------------------------ */
if ( ! function_exists( 'alx_pre_get_posts' ) ) {

	function alx_pre_get_posts( $query ) {
		// Are we on main query ?
		if ( !$query->is_main_query() ) return;
		if ( $query->is_home() ) {

			// Featured posts enabled
			if ( ot_get_option('featured-posts-count') != '0' ) {
				// Get featured post ids
				$featured_post_ids = alx_get_featured_post_ids();
				// Exclude posts
				if ( $featured_post_ids && !ot_get_option('featured-posts-include') )
					$query->set('post__not_in', $featured_post_ids);
			}
		}
	}

}
add_action( 'pre_get_posts', 'alx_pre_get_posts' );


/*  Script for no-js / js class
/* ------------------------------------ */
if ( ! function_exists( 'alx_html_js_class' ) ) {

	function alx_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}

}
add_action( 'wp_head', 'alx_html_js_class', 1 );


/*  IE js header
/* ------------------------------------ */
if ( ! function_exists( 'alx_ie_js_header' ) ) {

	function alx_ie_js_header () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( '//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js' ) . '"></script>'. "\n";
		echo '<script src="' . esc_url( '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}

}
add_action( 'wp_head', 'alx_ie_js_header' );


/*  IE js footer
/* ------------------------------------ */
if ( ! function_exists( 'alx_ie_js_footer' ) ) {

	function alx_ie_js_footer () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/respond.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}

}
add_action( 'wp_footer', 'alx_ie_js_footer', 20 );


/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'alx_plugins' ) ) {

	function alx_plugins() {
		if ( ot_get_option('recommended-plugins') != 'off' ) {
			// Add the following plugins
			$plugins = array(
				array(
					'name' 				=> 'Regenerate Thumbnails',
					'slug' 				=> 'regenerate-thumbnails',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'WP-PageNavi',
					'slug' 				=> 'wp-pagenavi',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'Responsive Lightbox',
					'slug' 				=> 'responsive-lightbox',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				),
				array(
					'name' 				=> 'Contact Form 7',
					'slug' 				=> 'contact-form-7',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation'=> false,
				)
			);
			tgmpa( $plugins );
		}
	}

}
add_action( 'tgmpa_register', 'alx_plugins' );


/*  WooCommerce basic support
/* ------------------------------------ */
function alx_wc_wrapper_start() {
	echo '<section class="content">';
	echo '<div class="pad">';
}
function alx_wc_wrapper_end() {
	echo '</div>';
	echo '</section>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'alx_wc_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'alx_wc_wrapper_end', 10);


/*  WP-PageNavi support - @devinsays (via GitHub)
/* ------------------------------------ */
function alx_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'alx_deregister_styles', 100 );

/* GetPageSpeed.com Optimizations begin */
add_filter('script_loader_src', 'gps_script_src', 10, 2);
add_filter('style_loader_src', 'gps_script_src', 10, 2);

function gps_script_src($src, $handle) {

	$wp_scripts = wp_scripts();
	//Check if script lives on this domain. Can't rewrite external scripts, they won't work.
	if($wp_scripts && !strstr( $src, $wp_scripts->base_url ) ) {
		if (false !== strpos($src, 'cdnjs')) {
			// no need for ver in cdnjs links
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	} else {
		$parts = array();
		parse_str(parse_url($src, PHP_URL_QUERY), $parts);

		$src = remove_query_arg( 'ver', $src );

		if (isset($parts['ver'])) {
			// rewrite the version value just before the extension
			$src = explode('.', $src);
			$partsCount = count($src);
			// if not css or js, just strip ver:
			if ($partsCount && !in_array($src[$partsCount - 1], array('js', 'css'))) {
				return implode('.', $src);
			}
			// some plugins already have number (date) in them, simply return without ver
			if ($partsCount >= 3 && is_numeric($src[$partsCount - 2 ])) {
				return implode('.', $src);
			}
			// all fine, do the ver pooping magic :p :D
			$ext = array_pop($src);
			$ver = $parts['ver'];
			// some jetpack assets has dash in ver, we only want pre-dash value:
			$ver = explode('-', $ver);
			$ver = $ver[0];
			// make sure it's integer because Nginx rewrite supports only style.1234.css format
			if (! is_integer($ver)) {
				$ver = crc32($ver);
				$var = sprintf("%u", $ver);
			}

			array_push($src, $ver, $ext);
			return implode('.', $src);

		} else {
			// TODO use filemtime here
			return $src;
		}
	}
}
/*
function gps_plugin_init() {
	if (! defined('AUTOPTIMIZE_PLUGIN_DIR')) {
		add_filter('script_loader_src', 'gps_script_src', 10, 2);
		add_filter('style_loader_src', 'gps_script_src', 10, 2);
	}
}
add_action( 'plugins_loaded', 'gps_plugin_init' );
*/

function gps_init() {

	if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ))) {

		$GLOBALS['jquery_snippets'] = array();
		$GLOBALS['slider_snippets'] = array();
		$GLOBALS['jplayer_snippets'] = array();
		$wp_scripts = wp_scripts();

		$jqueryCoreVersion = $wp_scripts->registered['jquery-core']->ver;
		wp_deregister_script('jquery-core');
		$url = sprintf('//cdnjs.cloudflare.com/ajax/libs/jquery/%s/jquery.min.js', $jqueryCoreVersion);
		wp_register_script('jquery-core', $url, array(), $jqueryCoreVersion, true);
		wp_enqueue_script('jquery-core');

		$jqueryMigrateVersion = $wp_scripts->registered['jquery-migrate']->ver;
		wp_deregister_script('jquery-migrate');
		$url = sprintf('//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/%s/jquery-migrate.min.js', $jqueryMigrateVersion);
		wp_register_script('jquery-migrate', $url, array(), $jqueryMigrateVersion, true);
		wp_enqueue_script('jquery-migrate');

	}
}
add_action('init', 'gps_init');


// Print library-specific snippets:
function gps_echo_snippets() {
	if( wp_script_is( 'jquery', 'done' ) ) {
		// print out accumulate slider snippets
		foreach ($GLOBALS['jquery_snippets'] as $snippet) {
			echo $snippet;
		}
	}
    if( wp_script_is( 'flexslider', 'done' ) ) {
    	// print out accumulate slider snippets
    	foreach ($GLOBALS['slider_snippets'] as $snippet) {
    		echo $snippet;
    	}
    }
    if( wp_script_is( 'jplayer', 'done' ) ) {
    	// print out accumulate slider snippets
    	foreach ($GLOBALS['jplayer_snippets'] as $snippet) {
    		echo $snippet;
    	}
    }
}
add_action( 'wp_footer', 'gps_echo_snippets', 100 );

function gps_add_conditional_scripts() {
	if (count($GLOBALS['slider_snippets'])) {
		wp_enqueue_script( 'flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.1/jquery.flexslider-min.js', array( 'jquery' ), '2.1', true );
	}
	if (count($GLOBALS['jplayer_snippets'])) {
		wp_enqueue_script( 'jplayer', '//cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js', array( 'jquery' ),'2.9.2', true );
	}
}
add_action( 'wp_footer', 'gps_add_conditional_scripts', 10 );

// remove emojis!
function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// kill devicepx shit by Jetpack:
function dequeue_devicepx() {
	wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_devicepx', 20 );
