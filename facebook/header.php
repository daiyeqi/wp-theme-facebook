<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="zh-CN" lang="zh-CN" >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php if ( is_single() ) { if ( $post->post_excerpt ) { $description  = $post->post_excerpt; } else { $description = facebook_substr(strip_tags(preg_replace("/ +/", " ", str_replace(array ("\r\n", "\"", "\\"), " ", $post->post_content))), 200); } echo '<meta name="description" content="'.$description.'" />'; } ?>
<meta name="author" content="Key"/>
<title><?php
global $page, $paged;
wp_title( ' &laquo; ', true, 'right' );
    bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";
    if ( $paged >= 2 || $page >= 2 )
      echo ' &laquo; ' . sprintf( 'Page %s', max( $paged, $page ) );
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js?ver=1.8.3"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.lazyload.mini.js?ver=1.0.1"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js?ver=1.0.3"></script>
</head>
<body <?php body_class(); ?>>
    <!-- topBar -->
    <div id="topbar"></div>
    <!-- topBar END -->
    <!-- globalContainer -->
    <div id="globalContainer">
        <!-- navigation -->
        <div id="nav_container" class="ptm clearfix" >
            <div id="pageLogo">
                <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>"></a>
            </div>
            <div class="lfloat">
                <g:plusone count="false"></g:plusone>
            </div>
            <div id="headNav" class="clearfix">
                <div class="lfloat">
                    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="navSearch">
                        <div class="wrap">
                            <span class="uiSearchInput textInput">
                                <span>
                                    <input type="text" class="inputtext" name="s" id="s" x-webkit-speech x-webkit-grammar="builtin:search" value="<?php the_search_query(); ?>" />
                                    <button type="submit" id="searchsubmit" title="Search"></button>
                                </span>
                            </span>
                        </div>
                    </form>
                </div>
                <?php wp_nav_menu( array( 'container_class' => 'menuNav webfont rfloat' , 'menu_id' => 'menu' ) ); ?>
            </div>
        </div>
