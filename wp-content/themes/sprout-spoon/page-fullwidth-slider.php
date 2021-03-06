<?php

	/* Template Name: Full Width Page w/ Featured Area */

?>
<?php get_header(); ?>
	
	<?php if(get_theme_mod( 'sprout_spoon_featured_hide_mobile' )) : ?>
		<?php if(wp_is_mobile() == false) : ?>
			<?php get_template_part('inc/featured/featured'); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php get_template_part('inc/featured/featured'); ?>
	<?php endif; ?>
	
	<?php if(is_active_sidebar('sidebar-3')) : ?>
	<div class="container">
		<div class="home-widget">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-3') ) ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="container">
		
		<div id="content">
		
			<div id="main" class="fullwidth">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<?php get_template_part('content', 'page'); ?>
						
				<?php endwhile; ?>
				
				<?php endif; ?>
				
			</div>

<?php get_footer(); ?>