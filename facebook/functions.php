<?php

add_action( 'after_setup_theme', 'facebook_setup' );

if ( ! function_exists( 'facebook_setup' ) ):

function facebook_setup() {
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
	) );
}
endif;

function facebook_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'facebook_page_menu_args' );

function facebook_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'facebook_excerpt_length' );

function add_nofollow_to_link($link) {
	return str_replace('<a', '<a rel="nofollow"', $link);
}
add_filter('the_content_more_link','add_nofollow_to_link', 0);

function facebook_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>' ) . '</a>';
}

function facebook_auto_excerpt_more( $more ) {
	return ' &hellip;' . facebook_continue_reading_link();
}
add_filter( 'excerpt_more', 'facebook_auto_excerpt_more' );

function facebook_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= facebook_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'facebook_custom_excerpt_more' );

function facebook_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'facebook_remove_gallery_css' );

if ( ! function_exists( 'facebook_comment' ) ) :

function facebook_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
		?>
<li <?php comment_class(); ?>
    id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="reply rfloat webfont clearfix disnone">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply'  ) ) ); ?>
        </div>
        <div class="comment-author vcard">
        <?php echo get_avatar( $comment, 45 ); ?>
        <?php printf( '<div class="fn says">%s says:</div>' , get_comment_author_link() ); ?>
        </div>
        <!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em><?php _e( 'Your comment is awaiting moderation.' ); ?> </em>
        <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata webfont">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php printf( date('F jS, Y \a\t H:i', get_comment_date('U')) ); ?></a>        
            <?php edit_comment_link( '[Edit]', ' ' );
            ?>
        </div>
        <!-- .comment-meta .commentmetadata -->

        <div class="comment-body">
        <?php comment_text(); ?>
        </div>

        <!-- .reply -->
    </div> <!-- #comment-##  --> 
    <?php
}


endif;

function facebook_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Left Widget Area',
		'id' => 'left-widget-area',
		'description' => 'The left widget area',
		'before_widget' => '<li class="widget-container %2$s">',
		'after_widget' => '</li><div class="hr-sidebar"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Right Widget Area',
		'id' => 'right-widget-area',
		'description' => 'The right widget area',
		'before_widget' => '<li class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
/** Register sidebars by running facebook_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'facebook_widgets_init' );

function facebook_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'facebook_remove_recent_comments_style' );

if ( ! function_exists( 'facebook_posted_on' ) ) :

function facebook_posted_on() {
	printf(  '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s,  %4$s ',
		'meta-prep author',
	sprintf( '<span class="entry-date" title="%1$s">%2$s</span>',
	date('F jS, Y H:i:s',get_the_time('U')),
	date('F jS, Y',get_the_time('U'))
	),
	sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
	get_author_posts_url( get_the_author_meta( 'ID' ) ),
	sprintf( esc_attr__( 'View all posts by %s' ), get_the_author() ),
	get_the_author()
	),
	sprintf( '<span class="cat-links"><span class="entity-cat-links">Posted in </span>%1$s</span> ',
	get_the_category_list( ', ' )
	)
	);
	printf( edit_post_link( 'Edit' , '<span class="edit-link">mgr. ', '</span>') );
}
endif;

if ( ! function_exists( 'facebook_paged_on' ) ) :

function facebook_paged_on() {
	printf(  '<span class="%1$s"></span> %2$s <span class="meta-sep">by</span> %3$s ',
		'meta-prep author',
	sprintf( '<span class="entry-date" title="%1$s">%2$s</span>',
	date('F jS, Y H:i:s',get_the_time('U')),
	date('F jS, Y',get_the_time('U'))
	),
	sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
	get_author_posts_url( get_the_author_meta( 'ID' ) ),
	sprintf( esc_attr__( 'View all posts by %s' ), get_the_author() ),
	get_the_author()
	)
	);
	printf( edit_post_link( 'Edit' , '<span class="edit-link">mgr. ', '</span>') );
}
endif;

if ( !function_exists('pagenavi') ) :

function pagenavi( $p = 5, $isBottom ) {
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( empty( $paged ) ) $paged = 1;
	if ($isBottom) {
		print "<div class='pages nav_bottom'>";
	} else {
		print "<div class='pages'>";
	}
	if ( $paged > 1 ) { p_link( $paged - 1, '上一页', 'Prev' ) ; } else { print '<span class="page-numbers ui-button-gray-disabled">Prev</span>' ; }
	if ( $paged > $p + 1 ) p_link( 1, 'First' );
	if ( $paged > $p + 2 ) print '<span class="page-numbers ui-button-gray-disabled">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers ui-button-gray-disabled'>{$i}</span>" : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) print '<span class="page-numbers ui-button-gray-disabled">...</span>';
	if ( $paged < $max_page - $p ) p_link( $max_page, 'Last' );
	if ( $paged < $max_page ) { p_link( $paged + 1,'下一页', 'Next' ) ; } else { print '<span class="page-numbers ui-button-gray-disabled">Next</span>' ; }
	print "</div>";
}

function p_link( $i, $title = '', $linktype = '' ) {
	if ( $title == '' ) $title = "第 {$i} 页";
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	printf ('<a class="page-numbers ui-button-gray" href="%1$s" title="%2$s">%3$s</a>',
	esc_html( get_pagenum_link( $i ) ),
	$title,
	$linktext
	);
}

endif;

if ( ! function_exists( 'facebook_posted_in' ) ) :

function facebook_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'facebook_substr' ) ) :

function facebook_substr($string, $length){
	if(strlen($string) > $length * 3) {
		return mb_substr($string, 0, $length, 'utf-8') . '....';
	} else { 
		return $string;
	}
}

endif;

if ( ! function_exists( 'facebook_recent_posts' ) ) :

function facebook_recent_posts() {
	$title = '<li class="widget-container widget_recent_entries">';
	$title .= '<h4 class="widget-title">';
	$title .= 'Recent Posts';
	$title .= '</h4>';
	if ( !$number = (int) $instance['number'] )
		$number = 10;
	else if ( $number < 1 )
		$number = 1;
	else if ( $number > 15 )
		$number = 15;
	$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
	if ($r->have_posts()) :
	echo $title ?>
	<ul><?php  while ($r->have_posts()) : $r->the_post(); 
	$postTitle = get_the_title();
	?>
	<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
	<?php if ( get_the_title() ) echo facebook_substr(get_the_title(), 15) ; else the_ID(); ?></a></li>
	<?php endwhile; ?></ul></li>
	<?php
	endif;
}	
		
endif;

if ( ! function_exists( 'facebook_recent_comments' ) ) :

function facebook_recent_comments() {
	global $comments, $comment;
	$commentTitle = '';
 	$output = '<li class="widget-container widget_recent_comments">';
 	$title = 'Recent Comments';

	if ( ! $number = (int) $instance['number'] )
 		$number = 10;
 	else if ( $number < 1 )
 		$number = 1;
 		
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'type' => 'comment' ) );
		$output .= '<h4 class="widget-title">';
		$output .= $title;

	$output .= '</h4><ul id="recentcomments">';
	if ( $comments ) {
		foreach ( (array) $comments as $comment) {
			$commentTitle = get_comment_excerpt();
			$output .=  '<li class="recentcomments">' . '<a href="' . esc_url( get_comment_link($comment->comment_ID) ).'" title="' . $commentTitle . '">' . facebook_substr($commentTitle, 15) . '</a></li>';
		}
 	}
	$output .= '</ul></li>';
	
	echo $output;
	
}
endif;

if ( ! function_exists( 'facebook_tag_cloud' ) ) :

function facebook_tag_cloud() {
	$output = '<li class="widget-container widget_tag_cloud">';
	$title = 'Tag Cloud';
	$output .= '<h4 class="widget-title">';
	$output .= $title;
	$output .= '</h4><ul>';
	echo $output;
	wp_cumulus_insert();
	echo '</ul></li>';
}

endif;

if ( ! function_exists( 'get_breadcrumbs' ) ) :

function get_breadcrumbs( $link = false ){

  $chain = '<ul id="crumb" class="breadcrumb webfont" itemprop="breadcrumb"><li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="http://b.doneta.org" rel="nofollow" itemprop="url"><span itemprop="title">Home</span></a></li><li class="separator">/</li>';
  $chain .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="http://b.doneta.org/categories/" rel="nofollow" itemprop="url"><span itemprop="title">All Categories</span></a></li><li class="separator">/</li>';
  if ( is_single() ) {
    $categorys = get_the_category(); 
    $cat  = $categorys[0];
  } else if ( is_category() ) {
    $cat = intval( get_query_var('cat') );
  }
  echo $chain . the_category_parents($cat, $link) . '</ul>';
}
		
endif;

if ( ! function_exists( 'the_category_parents' ) ) :

function the_category_parents(  $id, $link = false, $isparent = false, $visited = array() ) {
  $chain = '';
  $parent = &get_category( $id );
  if ( is_wp_error( $parent ) )
    return $parent;
  $name = $parent->name;
  if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
    $visited[] = $parent->parent;
    $chain .= the_category_parents( $parent->parent, true, true, $visited );
  }
  if( $isparent )
    $chain .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="' . esc_attr( sprintf( "View all posts in %s", $parent->name ) ) . '" itemprop="url"><span itemprop="title">'.$name.'</span></a></li><li class="separator">/</li>';
  else 
    if ( $link )
      $chain .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="' . esc_attr( sprintf( "View all posts in %s", $parent->name ) ) . '" itemprop="url"><h2 itemprop="title">'.$name.'</h2></a></li>';
    else
      $chain .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><h1 class="active" itemprop="title">'.$name.'</h1></li>';
  return $chain;
}

endif;