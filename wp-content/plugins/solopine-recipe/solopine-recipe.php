<?php
/*
Plugin Name: Solo Pine Recipes
Plugin URI: http://solopine.com
Description: Solo Pine Recipe Card and Recipe Index Shortcode
Author: Solo Pine
Version: 1.2
Author URI: http://solopine.com
Text Domain: solopine-recipe
*/

function sp_recipe_init() {

	define( 'SOLOPINE_RECIPE_BASE', plugin_basename( __FILE__ ) );
	
	// load language files
	load_plugin_textdomain( 'solopine-recipe', false, dirname( SOLOPINE_RECIPE_BASE ) . '/lang/' );
}
add_action( 'init', 'sp_recipe_init' );

/**
 * Adds a meta box to the post editing screen
 */
function solopine_custom_meta() {
    add_meta_box( 'solopine_meta', esc_html__( 'Post Options', 'solopine-recipe' ), 'solopine_meta_callback', 'post' );
	add_meta_box( 'solopine_meta', esc_html__( 'Page Options', 'solopine-recipe' ), 'solopine_meta_callback', 'page' ); 
}
add_action( 'add_meta_boxes', 'solopine_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function solopine_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'solopine_nonce' );
    $solopine_stored_meta = get_post_meta( $post->ID );
	global $typenow;
    ?>
	
	<?php if ( function_exists( 'sprout_spoon_theme_setup' ) ) : ?>
	<?php if($typenow == 'post') : ?>
	<p>
		<label for="meta-select" class="prfx-row-title"><?php esc_html_e( 'Post Layout:', 'solopine-recipe' )?></label>
		<select name="meta-select" id="meta-select">
			<option value="sidebar-post" <?php if ( isset ( $solopine_stored_meta['meta-select'] ) ) selected( $solopine_stored_meta['meta-select'][0], 'sidebar-post' ); ?>><?php esc_html_e( 'Post With Sidebar', 'solopine-recipe' )?></option>';
			<option value="full-post" <?php if ( isset ( $solopine_stored_meta['meta-select'] ) ) selected( $solopine_stored_meta['meta-select'][0], 'full-post' ); ?>><?php esc_html_e( 'Post Full Width', 'solopine-recipe' )?></option>';
		</select>
		<span class="solopine-description"><?php esc_html_e( 'Choose whether you want to display your post in a full width layout or with a sidebar.', 'solopine-recipe' )?></span>
	</p>
	<?php endif; ?>
	
	<p style="border-bottom:none;">
		<label for="meta-image" class="prfx-row-title"><?php esc_html_e( 'Custom Featured Area Image:', 'solopine-recipe' )?></label>
		<input type="text" name="meta-image" id="meta-image" value="<?php if ( isset ( $solopine_stored_meta['meta-image'] ) ) echo $solopine_stored_meta['meta-image'][0]; ?>" />
		<input type="button" id="meta-image-button" class="button" value="<?php esc_html_e( 'Choose or Upload an Image', 'solopine-recipe' )?>" />
		<span class="solopine-description"><?php esc_html_e( 'If you are planning to display this post/page in the featured area, you can set a custom image here.<br> If you leave this field blank, the slider will pick the featured image assigned to the post/page.', 'solopine-recipe'); ?></span>
	</p>
	<?php endif; ?>
	
	<?php if($typenow == 'post') : ?>
	<div class="recipe-post">
		<h3><?php esc_html_e( 'Recipe Card', 'solopine-recipe' )?></h3>
		
		<p><?php esc_html_e( 'Display your Recipe Card using the following shortcode', 'solopine-recipe' )?>: <span class="sp_shortcode">[sp_recipe]</span></p>
		
		<p>
			<label for="sp-recipe-title" class="prfx-row-title"><?php esc_html_e( 'Recipe Title:', 'solopine-recipe' )?></label>
			<input style="width:100%;" type="text" name="sp-recipe-title" id="sp-recipe-title" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-title'] ) ) echo $solopine_stored_meta['sp-recipe-title'][0]; ?>" />
		</p>
		
		<p>
			<label for="sp-recipe-description" class="prfx-row-title"><?php esc_html_e( 'Description:', 'solopine-recipe' )?></label>
			<textarea style="width:100%; height:90px;" name="sp-recipe-description" id="sp-recipe-description"><?php if ( isset ( $solopine_stored_meta['sp-recipe-description'] ) ) echo $solopine_stored_meta['sp-recipe-description'][0]; ?></textarea>
			<span class="solopine-description"><?php esc_html_e( 'A short description of the recipe', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-author" class="prfx-row-title"><?php esc_html_e( 'Recipe Author:', 'solopine-recipe' )?></label>
			<input style="width:180px;" type="text" name="sp-recipe-author" id="sp-recipe-author" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-author'] ) ) echo $solopine_stored_meta['sp-recipe-author'][0]; ?>" />
			<span class="solopine-description"><?php esc_html_e( 'Name of recipe author', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-servings" class="prfx-row-title"><?php esc_html_e( 'Servings:', 'solopine-recipe' )?></label>
			<input style="width:100px;" type="text" name="sp-recipe-servings" id="sp-recipe-servings" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-servings'] ) ) echo $solopine_stored_meta['sp-recipe-servings'][0]; ?>" />
			<span class="solopine-description"><?php esc_html_e( 'Example: 4', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-time" class="prfx-row-title"><?php esc_html_e( 'Cooking time:', 'solopine-recipe' )?></label>
			<input style="width:100px;" type="text" name="sp-recipe-time" id="sp-recipe-time" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-time'] ) ) echo $solopine_stored_meta['sp-recipe-time'][0]; ?>" />
			<span class="solopine-description"><?php esc_html_e( 'Example: 1 hour', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-time-prep" class="prfx-row-title"><?php esc_html_e( 'Preparation time:', 'solopine-recipe' )?></label>
			<input style="width:100px;" type="text" name="sp-recipe-time-prep" id="sp-recipe-time-prep" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-time-prep'] ) ) echo $solopine_stored_meta['sp-recipe-time-prep'][0]; ?>" />
			<span class="solopine-description"><?php esc_html_e( 'Example: 30 minutes', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-time-total" class="prfx-row-title"><?php esc_html_e( 'Total time:', 'solopine-recipe' )?></label>
			<input style="width:100px;" type="text" name="sp-recipe-time-total" id="sp-recipe-time-total" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-time-total'] ) ) echo $solopine_stored_meta['sp-recipe-time-total'][0]; ?>" />
			<span class="solopine-description"><?php esc_html_e( 'Example: 1 hour 30 minutes', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-ingredients" class="prfx-row-title"><?php esc_html_e( 'Ingredients:', 'solopine-recipe' )?></label>
			<textarea style="width:100%; height:180px;" name="sp-recipe-ingredients" id="sp-recipe-ingredients"><?php if ( isset ( $solopine_stored_meta['sp-recipe-ingredients'] ) ) echo $solopine_stored_meta['sp-recipe-ingredients'][0]; ?></textarea>
			<span class="solopine-description"><?php esc_html_e( 'Type each ingredient on a new line.', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-method" class="prfx-row-title"><?php esc_html_e( 'Instructions:', 'solopine-recipe' )?></label>
			<textarea style="width:100%; height:180px;" name="sp-recipe-method" id="sp-recipe-method"><?php if ( isset ( $solopine_stored_meta['sp-recipe-method'] ) ) echo $solopine_stored_meta['sp-recipe-method'][0]; ?></textarea>
			<span class="solopine-description"><?php esc_html_e( 'Type each step on a new line.', 'solopine-recipe' )?></span>
		</p>
		
		<p>
			<label for="sp-recipe-notes" class="prfx-row-title"><?php esc_html_e( 'Notes:', 'solopine-recipe' )?></label>
			<textarea style="width:100%; height:90px;" name="sp-recipe-notes" id="sp-recipe-notes"><?php if ( isset ( $solopine_stored_meta['sp-recipe-notes'] ) ) echo $solopine_stored_meta['sp-recipe-notes'][0]; ?></textarea>
			<span class="solopine-description"><?php esc_html_e( 'If you have any additional notes you can write them here.', 'solopine-recipe' )?></span>
		</p>
		
		<div class="nutrition">
			<h4><?php esc_html_e( 'Nutrition', 'solopine-recipe' )?></h4>
			<p>
				<label for="sp-recipe-calories" class="prfx-row-title"><?php esc_html_e( 'Calories:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-calories" id="sp-recipe-calories" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-calories'] ) ) echo $solopine_stored_meta['sp-recipe-calories'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of calories', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-carbohydrate" class="prfx-row-title"><?php esc_html_e( 'Carbohydrate:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-carbohydrate" id="sp-recipe-carbohydrate" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-carbohydrate'] ) ) echo $solopine_stored_meta['sp-recipe-carbohydrate'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of carbohydrates', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-cholesterol" class="prfx-row-title"><?php esc_html_e( 'Cholesterol:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-cholesterol" id="sp-recipe-cholesterol" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-cholesterol'] ) ) echo $solopine_stored_meta['sp-recipe-cholesterol'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of milligrams of cholesterol.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-fat" class="prfx-row-title"><?php esc_html_e( 'Fat:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-fat" id="sp-recipe-fat" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-fat'] ) ) echo $solopine_stored_meta['sp-recipe-fat'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of fat.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-fiber" class="prfx-row-title"><?php esc_html_e( 'Fiber:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-fiber" id="sp-recipe-fiber" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-fiber'] ) ) echo $solopine_stored_meta['sp-recipe-fiber'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of fiber.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-protein" class="prfx-row-title"><?php esc_html_e( 'Protein:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-protein" id="sp-recipe-protein" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-protein'] ) ) echo $solopine_stored_meta['sp-recipe-protein'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of protein.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-saturated-fat" class="prfx-row-title"><?php esc_html_e( 'Saturated fat:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-saturated-fat" id="sp-recipe-saturated-fat" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-saturated-fat'] ) ) echo $solopine_stored_meta['sp-recipe-saturated-fat'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of saturated fat.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-sodium" class="prfx-row-title"><?php esc_html_e( 'Sodium:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-sodium" id="sp-recipe-sodium" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-sodium'] ) ) echo $solopine_stored_meta['sp-recipe-sodium'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of milligrams of sodium.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-sugar" class="prfx-row-title"><?php esc_html_e( 'Sugar:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-sugar" id="sp-recipe-sugar" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-sugar'] ) ) echo $solopine_stored_meta['sp-recipe-sugar'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of sugar.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-trans-fat" class="prfx-row-title"><?php esc_html_e( 'Trans fat:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-trans-fat" id="sp-recipe-trans-fat" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-trans-fat'] ) ) echo $solopine_stored_meta['sp-recipe-trans-fat'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of trans fat.', 'solopine-recipe' )?></span>
			</p>
			
			<p>
				<label for="sp-recipe-unsaturated-fat" class="prfx-row-title"><?php esc_html_e( 'Unsaturated fat:', 'solopine-recipe' )?></label>
				<input style="width:90px;" type="text" name="sp-recipe-unsaturated-fat" id="sp-recipe-unsaturated-fat" value="<?php if ( isset ( $solopine_stored_meta['sp-recipe-unsaturated-fat'] ) ) echo $solopine_stored_meta['sp-recipe-unsaturated-fat'][0]; ?>" />
				<span class="solopine-description"><?php esc_html_e( 'The number of grams of unsaturated fat.', 'solopine-recipe' )?></span>
			</p>
			
		</div>
		
	</div>
	<?php endif; ?>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function solopine_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'solopine_nonce' ] ) && wp_verify_nonce( $_POST[ 'solopine_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-select' ] ) ) {
		update_post_meta( $post_id, 'meta-select', $_POST[ 'meta-select' ] );
	}
	
	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-image' ] ) ) {
		update_post_meta( $post_id, 'meta-image', $_POST[ 'meta-image' ] );
	}
	
	// Recipe
	if( isset( $_POST[ 'sp-recipe-title' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-title', $_POST[ 'sp-recipe-title' ] );
	}
	if( isset( $_POST[ 'sp-recipe-description' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-description', $_POST[ 'sp-recipe-description' ] );
	}
	if( isset( $_POST[ 'sp-recipe-author' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-author', $_POST[ 'sp-recipe-author' ] );
	}
	if( isset( $_POST[ 'sp-recipe-servings' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-servings', $_POST[ 'sp-recipe-servings' ] );
	}
	if( isset( $_POST[ 'sp-recipe-time' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-time', $_POST[ 'sp-recipe-time' ] );
	}
	if( isset( $_POST[ 'sp-recipe-time-prep' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-time-prep', $_POST[ 'sp-recipe-time-prep' ] );
	}
	if( isset( $_POST[ 'sp-recipe-time-total' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-time-total', $_POST[ 'sp-recipe-time-total' ] );
	}
	if( isset( $_POST[ 'sp-recipe-ingredients' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-ingredients', $_POST[ 'sp-recipe-ingredients' ] );
	}
	if( isset( $_POST[ 'sp-recipe-method' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-method', $_POST[ 'sp-recipe-method' ] );
	}
	if( isset( $_POST[ 'sp-recipe-notes' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-notes', $_POST[ 'sp-recipe-notes' ] );
	}
	if( isset( $_POST[ 'sp-recipe-calories' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-calories', $_POST[ 'sp-recipe-calories' ] );
	}
	if( isset( $_POST[ 'sp-recipe-carbohydrate' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-carbohydrate', $_POST[ 'sp-recipe-carbohydrate' ] );
	}
	if( isset( $_POST[ 'sp-recipe-cholesterol' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-cholesterol', $_POST[ 'sp-recipe-cholesterol' ] );
	}
	if( isset( $_POST[ 'sp-recipe-fat' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-fat', $_POST[ 'sp-recipe-fat' ] );
	}
	if( isset( $_POST[ 'sp-recipe-fiber' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-fiber', $_POST[ 'sp-recipe-fiber' ] );
	}
	if( isset( $_POST[ 'sp-recipe-protein' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-protein', $_POST[ 'sp-recipe-protein' ] );
	}
	if( isset( $_POST[ 'sp-recipe-saturated-fat' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-saturated-fat', $_POST[ 'sp-recipe-saturated-fat' ] );
	}
	if( isset( $_POST[ 'sp-recipe-sodium' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-sodium', $_POST[ 'sp-recipe-sodium' ] );
	}
	if( isset( $_POST[ 'sp-recipe-sugar' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-sugar', $_POST[ 'sp-recipe-sugar' ] );
	}
	if( isset( $_POST[ 'sp-recipe-trans-fat' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-trans-fat', $_POST[ 'sp-recipe-trans-fat' ] );
	}
	if( isset( $_POST[ 'sp-recipe-unsaturated-fat' ] ) ) {
		update_post_meta( $post_id, 'sp-recipe-unsaturated-fat', $_POST[ 'sp-recipe-unsaturated-fat' ] );
	}
 
}
add_action( 'save_post', 'solopine_meta_save' );

/**
 * Adds the meta box stylesheet when appropriate
 */
function solopine_admin_styles(){
    global $typenow;
    if( $typenow == 'post' || $typenow == 'page' ) {
        wp_enqueue_style( 'solopine_meta_box_styles', plugin_dir_url( __FILE__ ) . 'solopine-recipe-styles.css' );
    }
}
add_action( 'admin_print_styles', 'solopine_admin_styles' );

/**
 * Loads the image management Javascript
 */
function solopine_image_enqueue() {
    global $typenow;
    if( $typenow == 'post' || $typenow == 'page' ) {
        wp_enqueue_media();
 
        // Registers and enqueues the required Javascript.
        wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => esc_html__( 'Choose or Upload an Image', 'solopine-recipe' ),
                'button' => esc_html__( 'Use this image', 'solopine-recipe' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'solopine_image_enqueue' );

//////////////////////////////////////////////////////////////////
// Enqueue recipe CSS/JS
//////////////////////////////////////////////////////////////////
function solopine_recipe_load_scripts() {
	wp_enqueue_style('solopine-recipe-card', plugin_dir_url( __FILE__ ) . '/solopine-recipe-card.css');
	wp_enqueue_script('print', plugin_dir_url( __FILE__ ) . '/jQuery.print.js', array( 'jquery' ), '', true);
}
add_action( 'wp_enqueue_scripts','solopine_recipe_load_scripts' );

//////////////////////////////////////////////////////////////////
// Recipe shortcode
//////////////////////////////////////////////////////////////////

function sp_recipe_time_to_iso8601($time) {
    $units = array(
        "Y" => 365*24*3600,
        "D" =>     24*3600,
        "H" =>        3600,
        "M" =>          60,
        "S" =>           1,
    );

    $str = "P";
    $istime = false;

    foreach ($units as $unitName => &$unit) {
        $quot  = intval($time / $unit);
        $time -= $quot * $unit;
        $unit  = $quot;
        if ($unit > 0) {
            if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
                $str .= "T";
                $istime = true;
            }
            $str .= strval($unit) . $unitName;
        }
    }

    return $str;
}

function sp_recipe_func( $atts ){
	
	// get recipe info
	$recipe_title = get_post_meta( get_the_ID(), 'sp-recipe-title', true );
	$recipe_description = get_post_meta( get_the_ID(), 'sp-recipe-description', true );
	$recipe_author = get_post_meta( get_the_ID(), 'sp-recipe-author', true );
	$recipe_servings = get_post_meta( get_the_ID(), 'sp-recipe-servings', true );
	$recipe_time = get_post_meta( get_the_ID(), 'sp-recipe-time', true );
	$recipe_time_prep = get_post_meta( get_the_ID(), 'sp-recipe-time-prep', true );
	$recipe_time_total = get_post_meta( get_the_ID(), 'sp-recipe-time-total', true );
	$recipe_ingredients = get_post_meta( get_the_ID(), 'sp-recipe-ingredients', true );
	$recipe_method = get_post_meta( get_the_ID(), 'sp-recipe-method', true );
	$recipe_notes = get_post_meta( get_the_ID(), 'sp-recipe-notes', true );
	$recipe_calories = get_post_meta( get_the_ID(), 'sp-recipe-calories', true );
	$recipe_carbohydrate = get_post_meta( get_the_ID(), 'sp-recipe-carbohydrate', true );
	$recipe_cholesterol = get_post_meta( get_the_ID(), 'sp-recipe-cholesterol', true );
	$recipe_fat = get_post_meta( get_the_ID(), 'sp-recipe-fat', true );
	$recipe_fiber = get_post_meta( get_the_ID(), 'sp-recipe-fiber', true );
	$recipe_protein = get_post_meta( get_the_ID(), 'sp-recipe-protein', true );
	$recipe_saturated_fat = get_post_meta( get_the_ID(), 'sp-recipe-saturated-fat', true );
	$recipe_sodium = get_post_meta( get_the_ID(), 'sp-recipe-sodium', true );
	$recipe_sugar = get_post_meta( get_the_ID(), 'sp-recipe-sugar', true );
	$recipe_trans_fat = get_post_meta( get_the_ID(), 'sp-recipe-trans-fat', true );
	$recipe_unsaturated_fat = get_post_meta( get_the_ID(), 'sp-recipe-unsaturated-fat', true );
	
	// Turn ingredients and method into an array
	$recipe_ingredients_array = preg_split('/\r\n|[\r\n]/', $recipe_ingredients);
	$recipe_method_array = preg_split('/\r\n|[\r\n]/', $recipe_method);
	
	ob_start(); ?>
	
	<div class="sp-recipe" id="printthis">
		
		<div class="recipe-overview">
			
			<div class="recipe-image">
				<?php $recipe_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<?php if($recipe_image) : ?><img src="<?php echo esc_url($recipe_image); ?>"><?php endif; ?>
				<?php if(!get_theme_mod( 'sprout_spoon_recipe_print' )) : ?>
					<a href="#" onclick="jQuery('#printthis').print()" class="sp-print"><i class="fa fas fa-print"></i> <?php esc_html_e( 'Print Recipe', 'solopine-recipe' ); ?></a>
				<?php endif; ?>
			</div>
			
			<div class="recipe-header">
			
				<div class="recipe-title-header">
				
					<?php if($recipe_title) : ?>
						<h2><?php echo wp_kses_post($recipe_title); ?></h2>
					<?php endif; ?>
					<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
				
				</div>
			
				<?php if($recipe_servings || $recipe_time || $recipe_time_prep) : ?>
				<div class="recipe-meta">
				
					<div class="meta-row">
						
						<?php if($recipe_author || $recipe_servings) : ?><i class="far fa-user"></i><?php endif; ?>
						
						<?php if($recipe_author) : ?><span class="recipe-meta-item"><?php esc_html_e( 'By', 'solopine-recipe' ); ?> <?php echo $recipe_author; ?></span><?php endif; ?>
						<?php if($recipe_author && $recipe_servings) : ?><span class="separator">&#8211;</span><?php endif; ?>
						<?php if($recipe_servings) : ?><span class="recipe-meta-item"><?php esc_html_e( 'Serves', 'solopine-recipe' ); ?>: <?php echo wp_kses_post($recipe_servings); ?></span><?php endif; ?>
					
					</div>
					
					<div class="meta-row">
					
						<?php if($recipe_time_prep || $recipe_time) : ?><i class="far fa-clock"></i><?php endif; ?> 
						
						<?php if($recipe_time_prep) : ?>
						<?php $prep_cooktime = strtotime($recipe_time_prep, 0); ?>
						<span class="recipe-meta-item"><?php esc_html_e( 'Prep Time', 'solopine-recipe' ); ?>: <?php echo wp_kses_post($recipe_time_prep); ?></span>
						<?php endif; ?>
						<?php if($recipe_time_prep && $recipe_time) : ?><span class="separator">&#8211;</span><?php endif; ?>
						<?php if($recipe_time) : ?>
						<?php $cooktime = strtotime($recipe_time, 0); ?>
						<span class="recipe-meta-item"><?php esc_html_e( 'Cooking Time', 'solopine-recipe' ); ?>: <?php echo wp_kses_post($recipe_time); ?></span>
						<?php endif; ?>
						
					</div>
			
				</div>
				<?php endif; ?>
				
				<?php if($recipe_description) : ?>
					<div class="sep-line"></div>
					<div class="recipe-description"><p><?php echo wp_kses_post($recipe_description); ?></p></div>
				<?php endif; ?>
			
			</div>
			
		</div>
			
		<?php if($recipe_ingredients) : ?>
		<div class="recipe-ingredients">
							
			<h3 class="recipe-title"><?php esc_html_e( 'Ingredients', 'solopine-recipe' ); ?></h3>
			
			<ul>
				<?php foreach($recipe_ingredients_array as $ingredient) : ?>
					<?php if($ingredient) : ?>
					<li><span><?php echo wp_kses_post($ingredient); ?></span></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			
		</div>
		<?php endif; ?>
		
		<?php if($recipe_method) : ?>
		<div class="recipe-method">
							
			<h3 class="recipe-title"><?php esc_html_e( 'Instructions', 'solopine-recipe' ); ?></h3>
			
			<?php $number = 0; ?>
			<?php foreach($recipe_method_array as $method) : ?>
			
			<?php if($method) : ?>
			<?php $number++; ?>
			<div class="step">
				<span class="step-number"><?php echo $number; ?></span>
				<div class="step-content">
					<p><?php echo wp_kses_post($method); ?></p>
				</div>
			</div>
			<?php endif; ?>
			
			<?php endforeach; ?>
			
		</div>
		<?php endif; ?>
		
		<?php if($recipe_calories || $recipe_carbohydrate || $recipe_cholesterol || $recipe_fat || $recipe_fiber || $recipe_protein || $recipe_saturated_fat || $recipe_sodium || $recipe_sugar || $recipe_trans_fat || $recipe_unsaturated_fat) : ?>
		<div class="recipe-nutrition">
			<h3 class="recipe-title"><?php esc_html_e( 'Nutrition', 'solopine-recipe' ); ?></h3>
			<ul>
			<?php if($recipe_calories) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_calories); ?></span>
					<span class="nut-item"><?php esc_html_e( 'Calories', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_carbohydrate) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_carbohydrate); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Carbohydrates', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_cholesterol) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_cholesterol); ?>mg</span>
					<span class="nut-item"><?php esc_html_e( 'Cholesterol', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_fat) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_fat); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Fat', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_fiber) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_fiber); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Fiber', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_protein) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_protein); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Protein', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_saturated_fat) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_saturated_fat); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Saturated fat', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_sodium) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_sodium); ?>mg</span>
					<span class="nut-item"><?php esc_html_e( 'Sodium', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_sugar) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_sugar); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Sugar', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_trans_fat) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_trans_fat); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Trans fat', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			<?php if($recipe_unsaturated_fat) : ?>
			<li>
				<div class="nutrition-item">
					<span class="amount"><?php echo wp_kses_post($recipe_unsaturated_fat); ?>g</span>
					<span class="nut-item"><?php esc_html_e( 'Unsaturated fat', 'solopine-recipe' ); ?></span>
				</div>
			</li>
			<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
		
		<?php if($recipe_notes) : ?>
		<div class="recipe-notes">
			
			<h3 class="recipe-title"><?php esc_html_e( 'Notes', 'solopine-recipe' ); ?></h3>
			
			<p><?php echo wp_kses_post($recipe_notes); ?></p>
			
		</div>
		<?php endif; ?>
		
		<script type="application/ld+json">
			{
			  "@context": "http://schema.org",
			  "@type": "Recipe",
			  "url": "<?php echo get_the_permalink(); ?>",
			  "author": {
				"@type": "Thing",
				"name": "<?php echo $recipe_author; ?>"
			  },
			  "datePublished": "<?php echo get_the_date(); ?>",
			  "cookTime": "<?php echo sp_recipe_time_to_iso8601($cooktime); ?>",
			  "description": "<?php echo wp_kses_post($recipe_description); ?>",
			  "image": "<?php echo esc_url($recipe_image); ?>",
			  "recipeIngredient": [
				<?php
					$i = 0;
					$count_ingredients = count($recipe_ingredients_array);
				?>
				<?php foreach($recipe_ingredients_array as $ingredient) : ?>
					<?php if($ingredient) : ?>
					"<?php echo wp_kses_post($ingredient); ?>"<?php if ($i == $count_ingredients - 1) :?><?php else : ?>,<?php endif; ?>
					<?php $i++; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			  ],
			 
			  "name": "<?php echo wp_kses_post($recipe_title); ?>",
			  "nutrition": {
				"@type": "NutritionInformation",
				"calories": "<?php echo wp_kses_post($recipe_calories); ?><?php if($recipe_calories) : ?> cal<?php endif; ?>",
				"carbohydrateContent": "<?php echo wp_kses_post($recipe_carbohydrate); ?><?php if($recipe_carbohydrate) : ?> g<?php endif; ?>",
				"cholesterolContent": "<?php echo wp_kses_post($recipe_cholesterol); ?><?php if($recipe_cholesterol) : ?> mg<?php endif; ?>",
				"fatContent": "<?php echo wp_kses_post($recipe_fat); ?><?php if($recipe_fat) : ?> g<?php endif; ?>",
				"fiberContent": "<?php echo wp_kses_post($recipe_fiber); ?><?php if($recipe_fiber) : ?> g<?php endif; ?>",
				"proteinContent": "<?php echo wp_kses_post($recipe_protein); ?><?php if($recipe_protein) : ?> g<?php endif; ?>",
				"saturatedFatContent": "<?php echo wp_kses_post($recipe_saturated_fat); ?><?php if($recipe_saturated_fat) : ?> g<?php endif; ?>",
				"sodiumContent": "<?php echo wp_kses_post($recipe_sodium); ?><?php if($recipe_sodium) : ?> mg<?php endif; ?>",
				"sugarContent": "<?php echo wp_kses_post($recipe_sugar); ?><?php if($recipe_sugar) : ?> g<?php endif; ?>",
				"transFatContent": "<?php echo wp_kses_post($recipe_trans_fat); ?><?php if($recipe_trans_fat) : ?> g<?php endif; ?>",
				"unsaturatedFatContent": "<?php echo wp_kses_post($recipe_unsaturated_fat); ?><?php if($recipe_unsaturated_fat) : ?> g<?php endif; ?>"
			  },
			  "prepTime": "<?php echo sp_recipe_time_to_iso8601($prep_cooktime); ?>",
			  "totalTime": "<?php echo sp_recipe_time_to_iso8601($totaltime); ?>",
			  "recipeInstructions": [
				<?php
					$im = 0;
					$count_methods = count($recipe_method_array);
				?>
				<?php foreach($recipe_method_array as $method) : ?>
			
					<?php if($method) : ?>

						"<?php echo wp_kses_post($method); ?>"<?php if ($im == $count_methods - 1) :?><?php else : ?>,<?php endif; ?>
						
					<?php $im++; ?>
					<?php endif; ?>
				
				<?php endforeach; ?>
			  ],
			  <?php
				// Get rating meta fields
				$ratingValue = get_post_meta(get_the_ID(), 'ratings_average', true);
				$ratingCount = get_post_meta(get_the_ID(), 'ratings_users', true);
			  ?>
			  "recipeYield": "<?php echo wp_kses_post($recipe_servings); ?>"<?php if($ratingCount > 0) : ?>,<?php endif; ?>
			  <?php if($ratingCount > 0) : ?>
			  "aggregateRating": {
				"@type": "AggregateRating",
				"bestRating": "5",
				"ratingValue": "<?php echo $ratingValue; ?>",
				"ratingCount": "<?php echo $ratingCount; ?>"
			  }
			  <?php endif; ?>
			}
		</script>
		
	</div>
	<?php
	return ob_get_clean();
	
}
add_shortcode( 'sp_recipe', 'sp_recipe_func' );

//////////////////////////////////////////////////////////////////
// Customizer - Add color options
//////////////////////////////////////////////////////////////////
function solopine_recipe_register_theme_customizer( $wp_customize ) {
 	
	// Add Sections/Panels
	$wp_customize->add_section( 'solopine_new_section_recipe' , array(
		'title'      => __('Recipe Card Settings', 'solopine-recipe'),
		'description'=> '',
		'priority'   => 98,
	) );
		
	// Add Setting
	
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print',
			array(
				'sanitize_callback' => 'solopine_recipe_sanitize_checkbox',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_border',
			array(
				'default'     => '#dddddd',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_title',
			array(
				'default'     => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_meta',
			array(
				'default'     => '#888888',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_block_title',
			array(
				'default'     => '#999999',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_ing_color',
			array(
				'default'     => '#4C4A47',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_ing_bg',
			array(
				'default'     => '#f4f4f4',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_method_text',
			array(
				'default'     => '#4C4A47',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_step_bg',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_step_text',
			array(
				'default'     => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_note_text',
			array(
				'default'     => '#4C4A47',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_border',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_bg',
			array(
				'default'     => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_text',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_border_hover',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_bg_hover',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_print_text_hover',
			array(
				'default'     => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_meta_icon',
			array(
				'default'     => '#95AF7E',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_description',
			array(
				'default'     => '#666666',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_nutrition_border',
			array(
				'default'     => '#e8e8e8',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_setting(
			'sprout_spoon_recipe_nutrition_text',
			array(
				'default'     => '#4c4a47',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
			
	// Add Control
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'recipe_print',
				array(
					'label'      => esc_html__('Disable Print Button', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_border',
				array(
					'label'      => esc_html__('Recipe Card Border Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_border',
					'priority'	 => 2
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_title',
				array(
					'label'      => esc_html__('Recipe Card Title Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_title',
					'priority'	 => 3
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_border',
				array(
					'label'      => esc_html__('Print Button Border Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_border',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_bg',
				array(
					'label'      => esc_html__('Print Button BG Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_bg',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_text',
				array(
					'label'      => esc_html__('Print Button Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_border_hover',
				array(
					'label'      => esc_html__('Print Button Border Hover Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_border_hover',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_bg_hover',
				array(
					'label'      => esc_html__('Print Button BG Hover Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_bg_hover',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_print_text_hover',
				array(
					'label'      => esc_html__('Print Button Text Hover Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_print_text_hover',
					'priority'	 => 9
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_meta',
				array(
					'label'      => esc_html__('Recipe Card Servings/Time Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_meta',
					'priority'	 => 10
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_meta_icon',
				array(
					'label'      => esc_html__('Servings/Time Icons', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_meta_icon',
					'priority'	 => 12
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_description',
				array(
					'label'      => esc_html__('Description Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_description',
					'priority'	 => 13
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_block_title',
				array(
					'label'      => esc_html__('Ingredients, Instructions and Notes Title Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_block_title',
					'priority'	 => 14
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_ing_color',
				array(
					'label'      => esc_html__('Ingredients Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_ing_color',
					'priority'	 => 17
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_ing_bg',
				array(
					'label'      => esc_html__('Ingredients BG Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_ing_bg',
					'priority'	 => 19
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_method_text',
				array(
					'label'      => esc_html__('Instructions Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_method_text',
					'priority'	 => 22
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_step_bg',
				array(
					'label'      => esc_html__('Instructions Step Number BG Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_step_bg',
					'priority'	 => 26
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_step_text',
				array(
					'label'      => esc_html__('Instructions Step Number Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_step_text',
					'priority'	 => 29
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_note_text',
				array(
					'label'      => esc_html__('Notes Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_note_text',
					'priority'	 => 31
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_nutrition_border',
				array(
					'label'      => esc_html__('Nutrition Border Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_nutrition_border',
					'priority'	 => 33
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'recipe_nutrition_text',
				array(
					'label'      => esc_html__('Nutrition Text Color', 'solopine-recipe'),
					'section'    => 'solopine_new_section_recipe',
					'settings'   => 'sprout_spoon_recipe_nutrition_text',
					'priority'	 => 33
				)
			)
		);
		
}
add_action( 'customize_register', 'solopine_recipe_register_theme_customizer' );

function solopine_recipe_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function solopine_recipe_customizer_css() {
    ?>
    <style type="text/css">
	
		<?php if(get_theme_mod( 'sprout_spoon_recipe_border' )) : ?>.sp-recipe, .recipe-overview, .recipe-ingredients, .recipe-notes { border-color:<?php echo get_theme_mod( 'sprout_spoon_recipe_border' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_title' )) : ?>.post-entry .recipe-overview h2 { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_title' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_meta' )) : ?>.recipe-overview .recipe-meta, .recipe-overview .recipe-meta span i { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_meta' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_block_title' )) : ?>.post-entry .recipe-title { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_block_title' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_ing_color' )) : ?>.recipe-ingredients ul li { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_ing_color' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_ing_bg' )) : ?>.recipe-ingredients ul li:nth-child(odd) { background:<?php echo get_theme_mod( 'sprout_spoon_recipe_ing_bg' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_method_text' )) : ?>.post-entry .step-content p { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_method_text' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_step_bg' )) : ?>.step span.step-number { background:<?php echo get_theme_mod( 'sprout_spoon_recipe_step_bg' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_step_text' )) : ?>.step span.step-number { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_step_text' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_note_text' )) : ?>.post-entry .recipe-notes p { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_note_text' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_border' )) : ?>.recipe-overview a.sp-print { border-color:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_border' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_bg' )) : ?>.recipe-overview a.sp-print { background:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_bg' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_text' )) : ?>.recipe-overview a.sp-print { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_text' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_border_hover' )) : ?>.recipe-overview a.sp-print:hover { border-color:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_border_hover' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_bg_hover' )) : ?>.recipe-overview a.sp-print:hover { background:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_bg_hover' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_print_text_hover' )) : ?>.recipe-overview a.sp-print:hover { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_print_text_hover' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_meta_icon' )) : ?>.recipe-overview .recipe-meta i { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_meta_icon' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_description' )) : ?>.post-entry .recipe-description p, .recipe-description p { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_description' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_nutrition_border' )) : ?>.nutrition-item { border-color:<?php echo get_theme_mod( 'sprout_spoon_recipe_nutrition_border' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sprout_spoon_recipe_nutrition_text' )) : ?>.nutrition-item { color:<?php echo get_theme_mod( 'sprout_spoon_recipe_nutrition_text' ); ?>; }<?php endif; ?>
    </style>
    <?php
}
add_action( 'wp_head', 'solopine_recipe_customizer_css' );


//////////////////////////////////////////////////////////////////
// Recipe index shortcode
//////////////////////////////////////////////////////////////////
function sp_index_func( $atts ){
	
	$a = shortcode_atts( array(
        'cat' => '',
		'title' => '',
        'amount' => '3',
		'cols' => '3',
		'display_title' => 'yes',
		'display_cat' => 'no',
		'display_date' => 'yes',
		'display_image' => 'yes',
		'cat_link' => 'yes',
		'cat_link_text' => 'View All'
    ), $atts );
	
	$index_cat = $a['cat'];
	$index_title = $a['title'];
	$index_amount = $a['amount'];
	$index_cols = $a['cols'];
	$index_display_title = $a['display_title'];
	$index_display_cat = $a['display_cat'];
	$index_display_date = $a['display_date'];
	$index_display_image = $a['display_image'];
	$index_cat_link = $a['cat_link'];
	$index_cat_text = $a['cat_link_text'];
	
	$query = new WP_Query( array( 'category_name' => $index_cat, 'posts_per_page' => $index_amount, 'ignore_sticky_posts' => true ) );
	
	ob_start(); ?>
		
		<?php
			if($index_cat) : 
				$idObj = get_category_by_slug($index_cat); 
				$id = $idObj->term_id;
				$cat_link = get_category_link( $id );
			endif;
		?>
		
		<?php if($index_title) : ?>
		<h4 class="index-heading"><span><?php echo esc_html($index_title); ?></span>
		<?php if($index_cat_link == "yes" && $cat_link) : ?>
		<a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($index_cat_text); ?> <i class="fa fa-angle-double-right"></i></a>
		<?php endif; ?>
		</h4>
		<?php endif; ?>
		
		<?php if ( $query->have_posts() ) : ?>
		
		<?php if($index_cols == '3') : ?>
			<ul class="sp-grid col3">
		<?php elseif($index_cols == '2') : ?>
			<ul class="sp-grid col2">
		<?php elseif($index_cols == '4') : ?>	
			<ul class="sp-grid col4">
		<?php else : ?>	
			<ul class="sp-grid col3">
		<?php endif; ?>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<li>
			<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
				
				<?php if($index_display_image != 'no') : ?>
				<div class="post-img">
					<?php if($index_cols == 2 && is_page_template('page-fullwidth.php')) : ?>
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('sprout_spoon_col2-thumb'); ?></a>
					<?php elseif($index_cols == 2 && is_page_template('page-fullwidth-slider.php')) : ?>
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('sprout_spoon_col2-thumb'); ?></a>
					<?php else : ?>
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('sprout_spoon_misc-thumb'); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<div class="post-header">
					
					<?php if($index_display_cat == 'yes') : ?>
					<span class="cat"><?php the_category('<span>/</span> '); ?></span>
					<?php endif; ?>
					
					<?php if($index_display_title != 'no') : ?>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					
				</div>
				
				<?php if($index_display_date != 'no') : ?>
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
				<?php endif; ?>
				
			</article>
			</li>
		
		<?php endwhile; ?>
		
		</ul>
		
		<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>
	
	<?php
	return ob_get_clean();
	
}
add_shortcode( 'sp_index', 'sp_index_func' );
