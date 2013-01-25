<?php if ( post_password_required() ) : /* 密码保护情况下显示 */ ?>
<div id="comments">
	<ol class="commentlist">
		<li class="odd webfont">
     		<p>This post is password protected. Enter the password to view any comments.</p>
            <p>本文受密码保护。要查看评论，请输入密码。</p>
            <p>この投稿はパスワードで保護されています。コメントを閲覧するにはパスワードを入力してください。</p>
        </li>
    </ol>
</div>
<!-- #comments -->
    <?php
    return;
    endif;
    ?>

<?php
	// for WordPress 2.7 or higher
	if (function_exists('wp_list_comments')) {
		$trackbacks = $comments_by_type['pings'];
	// for WordPress 2.6.3 or lower
	} else {
		$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
	}
?>

<div id="comments">
<div id="commentstab" class="commentstabhr clearfix" >
	<?php if(pings_open()) : ?>
		<span id="commenttab" class="ctab rfloat acolor currtab rm2" ref="on" >Comments</span>
		<span id="trackbacktab" class="ctab rfloat acolor cotab" ref="off" >Trackbacks<?php  echo (' (' . count($trackbacks) . ')'); ?></span>
	<?php else : ?>
		<span id="commenttab" class="ctab rfloat acolor rm2 currtab" ref="on" >Comments</span>
	<?php endif; ?>
	<?php if(comments_open()) : ?>
		<span class="ctab addcomment lfloat lm1" ><a href="#respond" title="发表评论" >Leave a comment</a></span>
	<?php endif; ?>
</div>
<div class="hreview-aggregate disnone">
   <span class="item">
      <span class="fn"><?php echo get_the_title(); ?></span>
   </span>
   <span class="count"><?php echo count($comments); ?></span>
</div>

    
	<?php if ( $comments && count($comments) - count($trackbacks) > 0 ) : ?>
<ol class="commentlist">
<?php /* 评论列表 */
wp_list_comments( array( 'type' => 'comment', 'callback' => 'facebook_comment' ) );
?>
</ol>
	
<?php elseif ( ! comments_open() ) : ?>
<ol class="commentlist">
<li class="even webfont">
<p>Comments are closed.</p>
<p>评论已关闭</p>
<p>コメントは受け付けていません。</p>
</li>
</ol>
	
<?php else : ?>
<ol class="commentlist">
<li class="even webfont">
<p>No comments yet.</p>
<p>目前尚无任何评论.</p>
<p>コメントはまだありません。</p>
</li>
</ol>
		
<?php endif; ?>

<?php if (pings_open()) : ?>
<?php if ($trackbacks) : $trackbackcount = 0; ?>
<ol class="trackbackslist disnone">
	<li id="trackbackurl">
		<label for="trackback_url" class="webfont small" >TrackBack URL</label>
		<input type="text" name="trackback_url" class="webfont" size="60" value="<?php trackback_url(); ?>" readonly="readonly" onclick="this.select()" />
	</li>
	<?php foreach ($trackbacks as $comment) : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="rfloat webfont"><?php edit_comment_link( '[Edit]', '', ''); ?></div>
		<div class="title">
			<a href="<?php comment_author_url() ?>">
				<?php comment_author(); ?>
			</a>
		</div>
		<div class="comment-meta webfont">
			<?php printf( date('F jS, Y \a\t H:i', get_comment_date('U')) ); ?>
			 | <a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$trackbackcount); ?></a>
		</div>
		<blockquote>
        <?php comment_text(); ?>
        </blockquote>
	</li>
	<?php endforeach; ?>
</ol>
<?php else : ?>
	<ol class="trackbackslist disnone">
	<li id="trackbackurl">
		<label for="trackback_url" class="webfont small" >TrackBack URL</label>
		<input type="text" name="trackback_url" class="webfont" size="60" value="<?php trackback_url(); ?>" readonly="readonly" onclick="this.select()" />
	</li>
	<li class="odd webfont">
	<p>No trackbacks yet..</p>
	<p>目前尚无任何 trackbacks 和 pingbacks.</p>
	<p>トラックバックはまだありません。</p>
	</li>
	</ol>
<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : /* 评论是否打开 */ ?>

    <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : /* 是否登录 */ ?>
    <?php else : ?>
	<div id="respond" class="clearfix">
    <h3 id="reply-title" title="Leave a Reply">
    </h3>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ($user_ID) : ?>
			<?php
				if (function_exists('wp_logout_url')) {
					$logout_link = wp_logout_url();
				} else {
					$logout_link = get_option('siteurl') . '/wp-login.php?action=logout';
				}
			?>
			<div class="row">
				 Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><strong><?php echo $user_identity; ?></strong></a>.
				 <a href="<?php echo $logout_link; ?>" title="<?php _e('Log out of this account'); ?>">Logout &raquo</a>
			</div>

			<?php else : ?>

			<div id="author_info" class="webfont">
				<div class="row">
					<input type="text" name="author" id="author" class="textfield" value="<?php echo $comment_author; ?>" size="24" tabindex="1" />
					<label for="author" class="small">Name <?php if ($req) print('(required)'); ?></label>
				</div>
				<div class="row">
					<input type="text" name="email" id="email" class="textfield" value="<?php echo $comment_author_email; ?>" size="24" tabindex="2" />
					<label for="email" class="small">E-Mail (will not be published) <?php if ($req) print('(required)'); ?></label>
				</div>
				<div class="row">
					<input type="text" name="url" id="url" class="textfield" value="<?php echo $comment_author_url; ?>" size="24" tabindex="3" />
					<label for="url" class="small">Website</label>
				</div>
			</div>

		<?php endif; ?>

		<!-- comment input -->
		<div class="row">
			<textarea name="comment" id="comment" tabindex="4" rows="8" cols="80"></textarea>
		</div>

		<!-- comment submit and rss -->
		<div id="submitbox">
		    <?php cancel_comment_reply_link( '<button class="ui-button-green" title="Cancel Reply" >取消回复</button>' ); ?>
		    <input name="submit" type="submit" id="submit" class="ui-button-green" tabindex="5" value="发表评论" title="Submit Comment" />
			<?php if (function_exists('highslide_emoticons')) : ?>
				<div id="emoticon"><?php highslide_emoticons(); ?></div>
			<?php endif; ?>
			<?php comment_id_fields(); ?>
		</div>
	<?php do_action('comment_form', $post->ID); ?>
	</form>
    
	</div>
    <?php endif; ?>
    
<?php endif; ?>
</div>
<!-- #comments -->
