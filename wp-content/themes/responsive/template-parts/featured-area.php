<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$responsive_options = responsive_get_options();
//test for first install no database
$db = get_option( 'responsive_theme_options' );
//test if all options are empty so we can display default text if they are
$empty     = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;
$emtpy_cta = ( empty( $responsive_options['cta_text'] ) ) ? false : true;

?>

<div id="featured" class="grid col-940">

	<div id="featured-content" class="grid col-460">

		<h1 class="featured-title">
			<?php
			if ( isset( $responsive_options['home_headline'] ) && $db && $empty )
				echo $responsive_options['home_headline'];
			else {
				_e( 'HAPPINESS', 'responsive' );
			}
			?>
		</h1>

		<h2 class="featured-subtitle">
			<?php
			if ( isset( $responsive_options['home_subheadline'] ) && $db && $empty )
				echo $responsive_options['home_subheadline'];
			else
				_e( 'IS A WARM CUP', 'responsive' );
			?>
		</h2>

		<?php
		if ( isset( $responsive_options['home_content_area'] ) && $db && $empty ) {
			echo do_shortcode( wpautop( $responsive_options['home_content_area'] ) );
		} else {
			echo '<p>' . __( 'Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.', 'responsive' ) . '</p>';
		} ?>


		<?php if ( $responsive_options['cta_button'] == 0 ): ?>

			<div class="call-to-action">
                           <?php 
                           if($responsive_options['button_style'] == 'default')
                            {
                              $button_class = "blue button";
                            }
                           else  if($responsive_options['button_style'] == 'flat_style')
                            {
                               $button_class = "blue button flat";
                            }
                            ?>
				<a href="<?php echo $responsive_options['cta_url']; ?>" class="<?php echo $button_class; ?>">
					<?php
					if ( isset( $responsive_options['cta_text'] ) && $db && $emtpy_cta )
						echo $responsive_options['cta_text'];
					else
						_e( 'Call to Action', 'responsive' );
					?>
				</a>

			</div><!-- end of .call-to-action -->

		<?php endif; ?>

	</div><!-- end of .col-460 -->

	<div id="featured-image" class="grid col-460 fit">

		<?php $featured_content = ( !empty( $responsive_options['featured_content'] ) ) ? $responsive_options['featured_content'] : '<img class="aligncenter" src="' . get_template_directory_uri() . '/core/images/featured-image.png" width="440" height="300" alt="responsivepro featured image" />'; ?>

		<?php echo do_shortcode( wpautop( $featured_content ) ); ?>

	</div><!-- end of #featured-image -->

</div><!-- end of #featured -->
<?php if ( isset( $responsive_options['testimonials']) && $responsive_options['testimonials'] == '1') { ?>
<div id="testimonial_div" class="grid col-940">
	<?php 
	
		$responsive_testimonial_title = isset( $responsive_options['testimonial_title']) ?  $responsive_options['testimonial_title'] : 'Testimonial';
		$responsive_testimonial_id = $responsive_options['testimonial_val'];
		$responsive_testimonial_desc = get_post($responsive_testimonial_id);
		$responsive_testimonial_img        = wp_get_attachment_url( get_post_thumbnail_id( $responsive_testimonial_id ) );
		$responsive_testimonial_name      = get_the_title( $responsive_testimonial_id );
		$responsive_testimonial_desc_content = $responsive_testimonial_desc->post_content;
		
	?>
	<h2 class="section_title"> 
			<span><?php echo esc_html($responsive_testimonial_title); ?></span>
	</h2>
	<div class="testimonial_main_div">
		<div class="testimonial_img"><img src="<?php echo esc_url($responsive_testimonial_img); ?>" alt="<?php echo esc_attr($responsive_testimonial_name); ?>"/></div>
		<div class="testimonial_main_text">
		<p class="testimonial_author"><?php echo esc_html($responsive_testimonial_name); ?></p>		
		<p class="testimonial_text"><?php echo esc_html($responsive_testimonial_desc_content); ?></p>
		</div>
	</div>	
</div>

<?php }?>