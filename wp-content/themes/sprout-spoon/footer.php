<!-- END CONTENT -->
</div>

<!-- END CONTAINER -->
</div>

<footer id="footer">

    <div id="instagram-footer">
        <?php /* Widgetised Area */
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-2')) ?>
    </div>

    <?php if (!get_theme_mod('sprout_spoon_footer_share')) : ?>
        <div id="footer-social">
            <?php if (get_theme_mod('sprout_spoon_facebook')) : ?><a
                href="http://facebook.com/<?php echo esc_html(get_theme_mod('sprout_spoon_facebook')); ?>"
                target="_blank"><i class="fab fa-facebook-f"></i> <span><?php _e('Facebook', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_twitter')) : ?><a
                href="http://twitter.com/<?php echo esc_html(get_theme_mod('sprout_spoon_twitter')); ?>"
                target="_blank"><i class="fab fa-twitter"></i> <span><?php _e('Twitter', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_instagram')) : ?><a
                href="http://instagram.com/<?php echo esc_html(get_theme_mod('sprout_spoon_instagram')); ?>"
                target="_blank"><i class="fab fa-instagram"></i> <span><?php _e('Instagram', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_pinterest')) : ?><a
                href="http://pinterest.com/<?php echo esc_html(get_theme_mod('sprout_spoon_pinterest')); ?>"
                target="_blank"><i class="fab fa-pinterest-p"></i>
                <span><?php _e('Pinterest', 'sprout-spoon'); ?></span></a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_bloglovin')) : ?><a
                href="http://bloglovin.com/<?php echo esc_html(get_theme_mod('sprout_spoon_bloglovin')); ?>"
                target="_blank"><i class="far fa-heart"></i> <span><?php _e('Bloglovin', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_google')) : ?><a
                href="http://plus.google.com/<?php echo esc_html(get_theme_mod('sprout_spoon_google')); ?>"
                target="_blank"><i class="fab fa-google-plus-g"></i>
                <span><?php _e('Google +', 'sprout-spoon'); ?></span></a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_tumblr')) : ?><a
                href="http://<?php echo esc_html(get_theme_mod('sprout_spoon_tumblr')); ?>.tumblr.com/" target="_blank">
                <i class="fab fa-tumblr"></i> <span><?php _e('Tumblr', 'sprout-spoon'); ?></span></a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_youtube')) : ?><a
                href="http://youtube.com/<?php echo esc_html(get_theme_mod('sprout_spoon_youtube')); ?>"
                target="_blank"><i class="fab fa-youtube"></i> <span><?php _e('Youtube', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_dribbble')) : ?><a
                href="http://dribbble.com/<?php echo esc_html(get_theme_mod('sprout_spoon_dribbble')); ?>"
                target="_blank"><i class="fab fa-dribbble"></i> <span><?php _e('Dribbble', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_soundcloud')) : ?><a
                href="http://soundcloud.com/<?php echo esc_html(get_theme_mod('sprout_spoon_soundcloud')); ?>"
                target="_blank"><i class="fab fa-soundcloud"></i>
                <span><?php _e('Soundcloud', 'sprout-spoon'); ?></span></a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_vimeo')) : ?><a
                href="http://vimeo.com/<?php echo esc_html(get_theme_mod('sprout_spoon_vimeo')); ?>" target="_blank"><i
                        class="fab fa-vimeo-v"></i> <span><?php _e('Vimeo', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_linkedin')) : ?><a
                href="<?php echo esc_html(get_theme_mod('sprout_spoon_linkedin')); ?>" target="_blank"><i
                        class="fab fa-linkedin-in"></i> <span><?php _e('LinkedIn', 'sprout-spoon'); ?></span>
                </a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_snapchat')) : ?><a
                href="http://snapchat.com/add/<?php echo esc_html(get_theme_mod('sprout_spoon_snapchat')); ?>"
                target="_blank"><i class="fab fa-snapchat-ghost"></i>
                <span><?php _e('Snapchat', 'sprout-spoon'); ?></span></a><?php endif; ?>
            <?php if (get_theme_mod('sprout_spoon_rss')) : ?><a
                href="<?php echo esc_url(get_theme_mod('sprout_spoon_rss')); ?>" target="_blank"><i
                        class="fas fa-rss"></i> <span><?php _e('RSS', 'sprout-spoon'); ?></span></a><?php endif; ?>
        </div>
    <?php endif; ?>

</footer>

<!-- END WRAPPER -->
</div>

<div id="footer-copyright">

    <div class="container">
        <p class="left-copy"><?php echo wp_kses_post(get_theme_mod('sprout_spoon_footer_copyright_left', '&copy; Copyright 2018 - <a href="http://solopine.com">Solo Pine</a>. All Rights Reserved.')); ?></p>
        <?php if (!get_theme_mod('sprout_spoon_footer_top')) : ?><a href="#"
                                                                    class="to-top"><?php _e('Top', 'sprout-spoon'); ?>
            <i class="fas fa-angle-up"></i></a><?php endif; ?>
        <p class="right-copy"><?php echo wp_kses_post(get_theme_mod('sprout_spoon_footer_copyright_right', 'Разработано в <a href="http://solopine.com">Solo Pine</a>.')); ?></p>
    </div>

</div>

<?php wp_footer(); ?>
<script>
    jQuery('.pagination.pagi-grid .older a').html('Следующие посты <i class="fas fa-angle-right"></i>');
    jQuery('.pagination.pagi-grid .newer a').html('<i class="fas fa-angle-left"></i> Предыдущие посты');
</script>
</body>

</html>