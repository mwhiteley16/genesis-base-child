<?php
/*
 * Create Widget
 *
 * Function used to create widget area
 * Calls ACF fields using Widget ID
 *
*/
// Create Widget for Testimonials
if( !class_exists('classTestimonialsWidget') ) {
	class classTestimonialsWidget extends WP_Widget {

		/* Set Up the widget basics */
		public function __construct() {
			$widget_ops = array(
				'classname' => 'class_testimonials_widget',
				'description' => 'Class Testimonials Hours Widget',
			);
			parent::__construct( 'class_testimonials_widget', 'Class Testimonials Widget', $widget_ops );
		}

		/* Output content of widget */
		public function widget( $args, $instance ) {

			// outputs the content of the widget
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			// widget ID with prefix for use in ACF API functions
			$widget_id = 'widget_' . $args['widget_id'];

			$title = get_field( 'wd_class_testimonials_widget_title', $widget_id );
			$numPosts = get_field( 'wd_class_testimonials_number_to_show', $widget_id );
			$pageSlug = get_post_field( 'post_name', get_post() );

			echo $args['before_widget'];

			if ( $title ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}

			wp_reset_query();
               $testimonials_query= null;
               $testimonialsargs=array(
                    'post_type'      => 'testimonials',
                    'post_status'    => 'publish',
                    'posts_per_page' => $numPosts,
				'tax_query'      => array(
					array(
						'taxonomy' => 'testimonials_category',
						'field'    => 'slug',
						'terms'    => $pageSlug
					)
				)
               );
			$testimonials_query = new WP_Query( $testimonialsargs ); ?>
			<?php if ( $testimonials_query->have_posts() ) : ?>
				<div class="class-testimonials">
	                    <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>

						<?php the_title(); ?>

					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<?php echo $args['after_widget'];

		}

		/* Set Up the widget basics */
		public function form( $instance ) {
			// outputs the options form on admin
		}

		/* Process saving the widget */
		public function update( $new_instance, $old_instance ) {
			// processes widget options to be saved
		}

	}
}

//add_action( 'widgets_init', 'register_class_testimonials_widget' );
function register_class_testimonials_widget() {
	register_widget( 'classTestimonialsWidget' );
}
