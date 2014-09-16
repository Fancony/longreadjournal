<?php
/* Add Rss to Head */
add_theme_support( 'automatic-feed-links' ); 

/* register main menu */

register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'lrj' ),
	)
);
function register_front_menu() {
  register_nav_menu('frontpage-menu',__( 'Frontpage menu' ));
}
add_action( 'init', 'register_front_menu' );
/*-----------------------------------------------------------------------------------*/
/* get post date
/*-----------------------------------------------------------------------------------*/
function less_entry_date() {
 $date = sprintf( '<span><time class="entry-date" datetime="%2$s">%3$s</time></span>',
 esc_attr( get_the_time() ),
 esc_attr( get_the_date( 'c' ) ),
 esc_html( get_the_date() )
 );
 printf($date);
}

// returns estimated reading time in min assuming an average speed of 250 wpm 
function lrj_article_reading_time(){
	$content = get_post_field( 'post_content', $post->ID );
	$count = str_word_count( strip_tags( $content ) );
  	echo '&sdot; ' . ceil($count/230) . ' min read';
}

// returns post category linked to the category page
function less_post_category(){
	$category = get_the_category(); 
	printf('<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>');
}

// returns the name of the category on the category page
function less_current_category($cat){
	$this_category = get_category($cat);
	printf($this_category->category_nicename);
}

// add thumbnail support
add_theme_support('post-thumbnails'); 

/*-----------------------------------------------------------------------------------*/
/* Styles
/*-----------------------------------------------------------------------------------*/


	// Post Header Style
	add_action( 'add_meta_boxes', 'cd_meta_box_add' );  
	function cd_meta_box_add()  
	{  
    add_meta_box( 'my-meta-box-id', 'Post Header Style', 'cd_meta_box_cb', 'post', 'normal', 'high' );  
	}  

	function cd_meta_box_cb( $post )
	{
	// $post is already set, and contains an object: the WordPress post
	global $post;

	$values = get_post_custom( $post->ID );

	// We'll use this nonce field later on when saving.
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

	$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : ”;    ?>  
    	<label for="my_meta_box_select">Style</label>  
        <select name="my_meta_box_select" id="my_meta_box_select">  
        	<option value="standard" <?php selected( $selected, 'standard' ); ?>>Standard Title (left)</option>  
            <option value="center" <?php selected( $selected, 'center' ); ?>>Centered Title</option>  
        </select>  
    </p>  
    <?php      
	}  
	add_action( 'save_post', 'cd_meta_box_save' );
	function cd_meta_box_save( $post_id )  
	{  
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    		// if our nonce isn't there, or we can't verify it, bail 
    		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return; 
    			// if our current user can't edit this post, bail  
   				if( !current_user_can( 'edit_post' ) ) return;  
    				// now we can actually save the data  
    				$allowed = array(   
        			'a' => array( // on allow a tags  
            		'href' => array() // and those anchors can only have href attribute  
        		)  
    		);  
			if( isset( $_POST['my_meta_box_select'] ) )  
        	update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );  
		}  

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Shortcodes
/*-----------------------------------------------------------------------------------*/	
	add_shortcode('quote', 'content_quote');
	function content_quote( $atts, $content = null ) {
	return '<div class="quote-box-container"><div class="quote-box"><span>' . $content . '</span></div></div>';
	}
	add_shortcode('big-image', 'content_bigimage');
	function content_bigimage( $atts, $content = null ) {
	return '<div class="big-image" style="background-image:url(' . $content . ');"></div>';
	}
	add_shortcode('big-image-scroll', 'content_bigimagescroll');
	function content_bigimagescroll( $atts, $content = null ) {
	return '<div class="big-image-scroll" style="background-image:url(' . $content . ');"></div>';
	}
/*-----------------------------------------------------------------------------------*/
/* Sidebars
/*-----------------------------------------------------------------------------------*/		


/*-----------------------------------------------------------------------------------*/
/* Feat title alignment
/*-----------------------------------------------------------------------------------*/		
function lrj_align(){
global $post;
$key = 'my_meta_box_select';
$themeta = get_post_meta($post->ID, $key, TRUE);
if($themeta == 'center') { 
	$alignment ='centered';
} else {
	$alignment ='';
}
printf($alignment);
}