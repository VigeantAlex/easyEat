<?php
/*
Template Name: Reservation Page
*/
?>

<?php

	// Sanitize data, or initialize if they don't exist.
	$ci_name     = isset( $_POST['ci_name'] ) ? sanitize_text_field( trim( $_POST['ci_name'] ) ) : '';
	$ci_email    = isset( $_POST['ci_email'] ) ? sanitize_email( $_POST['ci_email'] ) : '';
	$ci_date     = isset( $_POST['ci_date'] ) ? sanitize_text_field( trim( $_POST['ci_date'] ) ) : '';
	$ci_people   = isset( $_POST['ci_people'] ) ? intval( $_POST['ci_people'] ) : '';
	$ci_comments = isset( $_POST['ci_comments'] ) ? sanitize_text_field( stripslashes( $_POST['ci_comments'] ) ) : '';

	$errorString = '';
	$emailSent   = false;

	if ( isset( $_POST['send_reservation'] ) ) {
		// We are here because the form was submitted. Let's validate!

		if ( empty( $ci_name ) or mb_strlen( $ci_name ) < 2 ) {
			$errorString .= '<li>' . __( 'Your name is required.', 'ci_theme' ) . '</li>';
		}
		if ( empty( $ci_email ) or ! is_email( $ci_email ) ) {
			$errorString .= '<li>' . __( 'A valid email is required.', 'ci_theme' ) . '</li>';
		}
		if ( empty( $ci_date ) ) {
			$errorString .= '<li>' . __( 'A valid date and time are required.', 'ci_theme' ) . '</li>';
		}
		if ( empty( $ci_people ) || ! is_numeric( $ci_people ) or $ci_people < 1 ) {
			$errorString .= '<li>' . __( 'A number of people is required.', 'ci_theme' ) . '</li>';
		}


		// Alright, lets send the email already!
		if ( empty( $errorString ) ) {
			$mailbody  = __( "Name:", 'ci_theme' ) . " " . $ci_name . "\n";
			$mailbody .= __( "Email:", 'ci_theme' ) . " " . $ci_email . "\n";
			$mailbody .= __( "Date:", 'ci_theme' ) . " " . $ci_date . "\n";
			$mailbody .= __( "Guests:", 'ci_theme' ) . " " . $ci_people . "\n";
			$mailbody .= __( "Message:", 'ci_theme' ) . " " . $ci_comments . "\n";

			// If you want to receive the email using the address of the sender, comment the next $emailSent = ... line
			// and uncomment the one after it.
			// Keep in mind the following comment from the wp_mail() function source:
				/* If we don't have an email from the input headers default to wordpress@$sitename
				* Some hosts will block outgoing mail from this address if it doesn't exist but
				* there's no easy alternative. Defaulting to admin_email might appear to be another
				* option but some hosts may refuse to relay mail from an unknown domain. See
				* http://trac.wordpress.org/ticket/5007.
				*/
			$emailSent = wp_mail( ci_setting( 'reservation_form_email' ), get_option( 'blogname' ) . ' - ' . __( 'Reservation form', 'ci_theme' ), $mailbody );
			//$emailSent = wp_mail( ci_setting( 'reservation_form_email' ), get_option( 'blogname' ) . ' - ' . __( 'Reservation form', 'ci_theme' ), $mailbody, 'From: "' . $ci_name . '" <' . $ci_email . '>' );
		}
	}
?>

<?php get_header(); ?>

<div id="main" class="row" role="main">
	<div class="eight columns">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="container shd">
					<div class="entry-content">
						<?php if ( ! empty( $errorString ) ) : ?>
							<ul id="formerrors">
								<?php echo $errorString; ?>
							</ul>
						<?php endif; ?>

						<?php if ( $emailSent === true ) : ?>
							<p id="formsuccess">
								<i class="fa fa-check"></i>
								<?php _e( 'Success! Your reservation request has been sent.', 'ci_theme' ); ?></p>
						<?php elseif ( $emailSent === false && isset($_POST['send_reservation']) && $errorString == '' ): ?>
							<p id="sendfail"><?php _e('There was a problem while sending the email. Please try again later.', 'ci_theme'); ?></p>
						<?php endif; ?>

						<?php if( !isset($_POST['send_reservation']) or (isset($_POST['send_reservation']) and !empty($errorString)) ): ?>
							<form class="reservations" action="<?php the_permalink(); ?>" method="post">
								<div class="row">
									<div class="six columns">
										<label for="ci_name"><?php _ex('Your Name *', 'reservation label', 'ci_theme'); ?></label>
										<input type="text" name="ci_name" id="ci_name" value="<?php echo esc_attr($ci_name); ?>" />
									</div>
									<div class="six columns">
										<label for="ci_email"><?php _ex('Your e-mail *', 'reservation label', 'ci_theme'); ?></label>
										<input type="email" name="ci_email" id="ci_email" value="<?php echo esc_attr($ci_email); ?>" />
									</div>
								</div>
								<div class="row">
									<div class="six columns">
										<label for="ci_date"><?php _ex('Date &amp; Time *', 'reservation label', 'ci_theme'); ?></label>
										<input type="text" name="ci_date" id="ci_date" value="<?php echo esc_attr($ci_date); ?>" />
										<div class="inline-datepicker"></div>
									</div>
									<div class="six columns">
										<label for="ci_people"><?php _ex('People *', 'reservation label', 'ci_theme'); ?></label>
										<input type="number" min="1" max="40" name="ci_people" id="ci_people" value="<?php echo esc_attr($ci_people); ?>" />
									</div>
								</div>

								<div class="row">
									<div class="twelve columns">
										<label for="ci_comments"><?php _ex('Comments', 'reservation label', 'ci_theme'); ?></label>
										<textarea name="ci_comments" id="ci_comments" cols="30" rows="10" placeholder="<?php echo esc_attr_x('e.g. special requests, etc', 'reservation label', 'ci_theme'); ?>"><?php echo esc_textarea($ci_comments); ?></textarea>
									</div>
								</div>

								<button type="submit" class="btn btn-sm" name="send_reservation"><?php _ex('Submit', 'reservation label', 'ci_theme'); ?></button>
							</form>
						<?php endif; ?>

						<?php ci_e_content(); ?>
					</div>
				</div>
			</article>
		<?php endwhile; endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div> <!-- #main -->

<?php get_footer(); ?>
