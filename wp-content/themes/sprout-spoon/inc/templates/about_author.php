<?php if(get_the_author_meta('description') || get_the_author_meta('facebook') || get_the_author_meta('twitter') || get_the_author_meta('instagram') || get_the_author_meta('google') || get_the_author_meta('pinterest') || get_the_author_meta('tumblr')) : ?>
<div class="post-author">
		
	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('email'), '80' ); ?>
	</div>
	
	<div class="author-content">
		<h5><span class="about-italic"><?php esc_html_e( 'About', 'sprout-spoon' ); ?></span> <?php the_author_posts_link(); ?></h5>
		<?php if(get_the_author_meta('description')) : ?>
		<p><?php the_author_meta('description'); ?></p>
		<?php endif; ?>
		<?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-social" href="http://facebook.com/<?php echo esc_html(the_author_meta('facebook')); ?>"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-social" href="http://twitter.com/<?php echo esc_html(the_author_meta('twitter')); ?>"><i class="fab fa-twitter"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-social" href="http://instagram.com/<?php echo esc_html(the_author_meta('instagram')); ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('google')) : ?><a target="_blank" class="author-social" href="http://plus.google.com/<?php echo esc_html(the_author_meta('google')); ?>?rel=author"><i class="fab fa-google-plus-g"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-social" href="http://pinterest.com/<?php echo esc_html(the_author_meta('pinterest')); ?>"><i class="fab fa-pinterest-p"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('tumblr')) : ?><a target="_blank" class="author-social" href="http://<?php echo esc_html(the_author_meta('tumblr')); ?>.tumblr.com/"><i class="fab fa-tumblr"></i></a><?php endif; ?>
	</div>
	
</div>
<?php endif; ?>