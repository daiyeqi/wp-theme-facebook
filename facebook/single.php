<?php get_header(); ?>
        <!-- content -->
        <div id="mainContent" class="content">
            <div id="mainContainer" class="clearfix">
                <div id="contentCol" class="main">
                    <div id="contentArea" class="section singleArea clearfix">
                    	<div id="postnavi" class="pages clearfix">
                        <span class="next rfloat"><?php previous_post_link('%link &raquo') ?></span>
                        <span class="prev lfloat"><?php next_post_link('&laquo; %link') ?></span>
                      </div>
                      <?php get_breadcrumbs( true ) ?>
                      <?php get_template_part( 'loop', 'single' ); ?>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <script type='text/javascript'>bindShareList();</script>
<?php get_footer(); ?>