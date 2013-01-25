<?php get_header(); ?>
        <!-- content -->
        <div id="mainContent" class="content">
            <div id="mainContainer" class="clearfix">
                <div id="contentCol" class="main">
                    <div id="contentArea" class="section notSingleArea clearfix">
                        <?php get_template_part( 'loop', 'index' ); ?>
                    </div>
                    <div id="rightCol">
                        <ul class="right-widget">
                        <?php facebook_recent_posts() ; ?>
                        <?php facebook_recent_comments() ; ?>
                        <?php dynamic_sidebar( 'right-widget-area' ); ?>
                        </ul>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
<?php get_footer(); ?>