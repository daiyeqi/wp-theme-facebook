<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
        <!-- content -->
        <div id="mainContent" class="content">
            <div id="mainContainer" class="clearfix">
                <div id="contentCol" class="main">
                    <div id="contentArea" class="section singleArea clearfix">
                    	<div id="postnavi" class="pages clearfix">
                      </div>
                      <div class="adbanner">
                          <!-- banner -->
                          <script type='text/javascript'>
                          GA_googleFillSlot("banner");
                          </script>
                      </div>
<div class="devesingle page">	

	<h1 class=" arcicons zhenghei"><?php the_title(); ?><?php edit_post_link('<span class="edit">[edit]　</span>');?></h1>	
		<section class="content archivelist">
			<span class="arc-collapse right">展开所有月份</span>
									<?php
									$previous_year = $year = 0;
									$previous_month = $month = 0;
									$ul_open = false;
									$myposts = get_posts('numberposts=-1&amp;orderby=post_date&amp;order=DESC');
									?>
									<?php foreach($myposts as $post) : ?>
										<?php
										global $post;
										setup_postdata($post);
										$year = mysql2date('Y', $post->post_date);
										$month = mysql2date('n', $post->post_date);
										$day = mysql2date('d', $post->post_date);
										?>
										<?php if($year != $previous_year || $month != $previous_month) : ?>
											<?php if($ul_open == true) : ?>
											</ul>
											<?php endif; ?>
											<h3><?php the_time('Y年m月'); ?></h3>
											<ul>
											<?php $ul_open = true; ?>
											<?php endif; ?>
											<?php $previous_year = $year; $previous_month = $month; ?>
												<li class="acclist"><?php echo $day ?>日 : <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
											<?php endforeach; ?>
											</ul>
		</section>


</div>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
<?php get_footer(); ?>