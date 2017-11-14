<?php
if ( ! class_exists( 'CI_Testimonials' ) ):
class CI_Testimonials extends WP_Widget {

	function __construct(){
		$widget_ops  = array( 'description' => __( 'Testimonials widget', 'ci_theme' ) );
		$control_ops = array(/*'width' => 300, 'height' => 400*/ );
		parent::__construct( false, $name = __( '-= CI Testimonials =-', 'ci_theme' ), $widget_ops, $control_ops );

		// These are needed for compatibility with < v2.0
		add_filter( 'widget_display_callback', array( $this, '_rename_old_title_field' ), 10, 2 );
		add_filter( 'widget_form_callback', array( $this, '_rename_old_title_field' ), 10, 2 );
	}

	// This is needed for compatibility with < v2.0
	function _rename_old_title_field( $instance, $_this ) {
		$old_field = 'ci_title';
		$class     = get_class( $this );

		if ( get_class($_this) == $class && ! isset( $instance['title'] ) && isset( $instance[ $old_field ] ) ) {
			$instance['title'] = $instance[ $old_field ];
			unset( $instance[ $old_field ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		global $post;

		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$ci_count  = $instance['ci_count'];
		$ci_random = $instance['ci_random'];

		if ( $ci_random == 'enabled' ) {
			$ci_random = 'rand';
		} else {
			$ci_random = 'post_date';
		}
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo '<div class="widget widget_ci_testimonial shd"><div class="testimonial-sld flexslider">';
		echo '<ul class="slides">';

		$posts = get_posts( array(
			'numberposts' => $ci_count,
			'orderby'     => $ci_random,
			'post_type'   => 'testimonial'
		) );
		
		$old_post = $post;

		if ( count( $posts ) > 0 ) {
			foreach ( $posts as $post ) {
				setup_postdata( $post );
				echo '<li><blockquote>';
				echo '<p>' . get_the_content() . '</p>';
					echo '<cite>';
					echo get_the_title();
					echo '</cite>';
				echo '</blockquote></li>';
			}
		}
		
		echo '</ul></div></div>';
		echo $after_widget;

		$post = $old_post;
		setup_postdata( $post );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']     = stripslashes( $new_instance['title'] );
		$instance['ci_count']  = intval( $new_instance['ci_count'] );
		$instance['ci_random'] = ci_sanitize_checkbox( $new_instance['ci_random'], 'enabled' );

		return $instance;
	}
	 
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title'        => __( 'Testimonials', 'ci_theme' ),
			'ci_count'     => 2,
			'ci_random'    => 'enabled',
		) );

		$title        = $instance['title'];
		$ci_count     = $instance['ci_count'];
		$ci_random    = $instance['ci_random'];

		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . __( 'Title:', 'ci_theme' ) . '</label><input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . esc_attr( $title ) . '" class="widefat" /></p>';
		echo '<p><label for="' . $this->get_field_id( 'ci_count' ) . '">' . __( 'Number of testimonials:', 'ci_theme' ) . '</label><input id="' . $this->get_field_id( 'ci_count' ) . '" name="' . $this->get_field_name( 'ci_count' ) . '" type="text" value="' . esc_attr( $ci_count ) . '" class="widefat" /></p>';
		echo '<p><input type="checkbox" name="' . $this->get_field_name( 'ci_random' ) . '" id="' . $this->get_field_id( 'ci_random' ) . '" value="enabled" ' . checked( $ci_random, 'enabled', false ) . ' /> <label for="' . $this->get_field_id( 'ci_random' ) . '">' . __( 'Show random testimonials', 'ci_theme' ) . '</label></p>';
	}

} // class

register_widget( 'CI_Testimonials' );

endif; // !class_exists
