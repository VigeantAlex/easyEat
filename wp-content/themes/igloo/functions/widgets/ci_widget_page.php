<?php
if ( ! class_exists( 'CI_Page_Widget' ) ):
class CI_Page_Widget extends WP_Widget {

	function __construct(){
		$widget_ops  = array( 'description' => __( 'Displays a single page with a featured image and title', 'ci_theme' ) );
		$control_ops = array(/*'width' => 300, 'height' => 400*/ );
		parent::__construct( 'ci_page_widget', $name = __( '-= CI Page =-', 'ci_theme' ), $widget_ops, $control_ops );

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

	function widget($args, $instance) {
		global $post;
		$old_post = $post;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		extract($args);

		$ci_post_id = $instance['post_id'];

		$post = get_post( $ci_post_id );

		if ( $post !== null ) {
			echo $before_widget;
			setup_postdata($post);
			?>
			<div class="block shd">
				<figure class="block-thumb">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('ci_thumb'); ?>
						<div class="overlay"></div>
					</a>
				</figure>

				<?php if ( $title ) : ?>
					<div class="block-title">
						<?php echo $before_title; ?><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a><?php echo $after_title; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			echo $after_widget;
		}

		$post = $old_post;
		setup_postdata($post);
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['post_id'] = intval( $new_instance['post_id'] );
		$instance['title']   = stripslashes( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'   => '',
			'post_id' => 0
		) );

		$ci_post_id = intval( $instance['post_id'] );
		$title      = htmlspecialchars( $instance['title'] );

		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . __( 'Title:', 'ci_theme' ) . '</label><input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . esc_attr( $title ) . '" class="widefat" /></p>';
		echo '<p><label for="' . $this->get_field_id( 'post_id' ) . '">' . __( 'Select a Page to show:', 'ci_theme' ) . '</label></p>';
		wp_dropdown_pages( array(
			'selected' => $ci_post_id,
			'id'       => $this->get_field_id( 'post_id' ),
			'name'     => $this->get_field_name( 'post_id' )
		) );
	}

} // class

register_widget( 'CI_Page_Widget' );

endif; // class_exists
