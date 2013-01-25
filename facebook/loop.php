<?php if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
<h1 class="title">Not Found</h1>
<div class="content webfont">
<img src="http://static.doneta.org/images/misaka.png" alt="404 Not Found" />
<p>Apologies, but no results were found for the requested archive. </p>
<p>抱歉，您浏览的页面未找到。</p>
<p>リクエストされたアーカイブには何も見つかりませんでした。</p>
</div>
</div>
<?php else : ?>


<?php if (  $wp_query->max_num_pages > 1 && have_posts() ) : ?>
<?php pagenavi(3, false); ?>
<!-- #nav-below -->
<?php endif; ?>
<?php if (is_category()) get_breadcrumbs();?>
<div class="posts blog-posts">
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="post-title title"><?php if (is_single()) :?>
<a href="javascript:void(0);" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php else : ?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php endif; ?><?php the_title(); ?></a></h2>
			<div class="post-meta meta">
                <?php if ( post_password_required() ) : ?>
                <span class="post-lock"></span>
                <?php else : ?>
                <span class="post-post"></span>
                <?php endif; ?>
                <?php if (!is_page()) :?>
				<?php facebook_posted_on(); ?>
				<?php else :?>
				<?php facebook_paged_on(); ?>
				<?php endif;?>
			</div><!-- .meta -->
			<div class="hr-containerArea"></div>

			<?php if ( post_password_required() ) : ?>
			<div class="post-body content clearfix">
            <form action="<?php bloginfo('url'); ?>/wp-pass.php" method="post">
				<blockquote>
        		<span>This post is password protected. To view it please enter your password below: </span><br />
				<span>这是一篇受密码保护的文章。您需要提供访问密码: </span><br />
				<span>この投稿はパスワードで保護されています. 表示するにはパスワードを入力してください: </span><br /></blockquote>
                <p><label for='pwbox-<?php the_ID(); ?>' >Password:  <input name="post_password" id='pwbox-<?php the_ID(); ?>' type="password" size="20" /></label> 
                <input class="ui-button-green input-ui-button" type="submit" name="Submit" value="Submit" /></p>
            </form>
            </div><!-- .content -->
      <?php else : ?>			
			<div class="post-body content">
				<?php the_content( 'More...' ); ?>
			</div><!-- .content -->
			<?php endif; ?>
            <?php if (is_single()) :?>
            <div id="share-bottom" class="post-footer share">
              <strong>Share on:</strong>
              <a rel="nofollow external" class="facebook-share" title="Facebook">Facebook</a>
              <a rel="nofollow external" class="twitter-share" title="Twitter">Twitter</a>
              <a rel="nofollow external" class="delicious-share" title="Delicious">Delicious</a>
              <a rel="nofollow external" class="sina-share" title="新浪微博">新浪微博</a>
              <a rel="nofollow external" class="douban-share" title="豆瓣">豆瓣</a>
              <a rel="nofollow external" class="fanfou-share" title="饭否">饭否</a>
              <a rel="nofollow external" class="renren-share" title="人人网">人人网</a>
              <a rel="nofollow external" class="kaixin001-share" title="开心网">开心网</a>
              <a rel="nofollow external" class="tencent-share" title="腾讯微博">腾讯微博</a>
              <a rel="nofollow external" class="sohu-share" title="搜狐微博">搜狐微博</a>
            </div>
            <?php endif; ?>
			<?php if ( !is_search()  ) : ?>
            <div class="post-footer utility webfont">
                 <?php printf( '<span class="%1$s">Tagged: </span> %2$s' , 'entity-tag-links',  get_the_tag_list( '', ' , ' ) ); ?>
                    <span class="comments-link">
                 <?php if ( comments_open() ) : ?>
                 	<?php comments_popup_link( 'Leave a comment' , '1 Comment' , '% Comments' ); ?>
                 <?php else : ?>
                 	<a href="javascript:void(0)" title="评论已关闭">Comments Off</a>
                 <?php endif; ?>
                 </span>
            </div>
            <?php endif; ?>
            <?php if (is_single()) :?>
            <div id="announce" class="post-footer msg-info">
                <strong>声明:</strong> 本文 "<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>" 采用 <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" rel="license nofollow external"><abbr title="署名-非商业性使用-相同方式共享">BY-NC-SA</abbr></a> 协议进行授权. <br />转载请注明原文地址: <a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
            </div>
			    <?php wp_link_pages( array( 'before' => '<div class="page-link pages singlepages">' .  '<span class="postpage">Post pages: </span>', 'after' => '</div>' ) ); ?>
			<?php endif; ?>
            <!-- .utility -->
		</div><!-- #post-## -->
        
		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>
</div>

<?php if (  $wp_query->max_num_pages > 1 && have_posts() ) : ?>
<?php pagenavi(3, true); ?>
<!-- #nav-below -->
<?php endif; ?>
<?php endif; ?>
