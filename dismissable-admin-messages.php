<?php
/*
Plugin Name: Dismissible WordPress Admin Notices
Plugin URI: http://manofhustle.com
Description: Adds the ability to dismiss WordPress admin notices.
Author: ebinnion
Version: 0.1
Author URI: http://manofhustle.com
*/

class Dismissable_Admin_Messages {

	public function __construct() {
		add_action( 'current_screen', array( $this, 'admin_init' ) );
	}

	public function admin_init() {
		$screen = get_current_screen();
		$showOn = array( 'post', 'page' );

		if ( in_array( $screen->id, $showOn ) ) {
			if ( isset( $_GET['message'] ) ) {
				add_action( 'admin_head', array( $this, 'admin_head' ) );
				add_action( 'admin_footer', array( $this, 'admin_footer' ) );
			}
		}
	}

	public function admin_head() {
		?>
		<style>
			#message {
				position: relative;
			}

			#message .dashicons-no {
				cursor: pointer;
				margin-top: -.5em;
				position: absolute;
				right: 10px;
				top: 50%;
			}
		</style>
		<?php
	}

	public function admin_footer() {
		?>
		<script>
			(function( $ ) {
				var message = $( '.wrap > #message' );
				message.append( '<span class="dashicons dashicons-no"></span>' );
				message.find( '.dashicons-no' ).on( 'click', function() {
					message.slideUp();
				} );
			})( jQuery );
		</script>
		<?php
	}
}

new Dismissable_Admin_Messages();
