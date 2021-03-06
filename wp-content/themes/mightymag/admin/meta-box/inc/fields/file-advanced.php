<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

require_once RWMB_FIELDS_DIR . 'file.php';
if ( ! class_exists( 'RWMB_File_Advanced_Field' ) )
{
	class RWMB_File_Advanced_Field extends RWMB_File_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			parent::admin_enqueue_scripts();
			wp_enqueue_script( 'rwmb-file-advanced', RWMB_JS_URL . 'file-advanced.js', array( 'jquery', 'wp-ajax-response' ), RWMB_VER, true );
		}

		/**
		 * Add actions
		 *
		 * @return void
		 */
		static function add_actions()
		{
			parent::add_actions();

			// Attach images via Ajax
			add_action( 'wp_ajax_rwmb_attach_file', array( __CLASS__, 'wp_ajax_attach_file' ) );
		}

		static function wp_ajax_attach_file()
		{
			$post_id = is_numeric( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : 0;
			$field_id = isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			$attachment_id    = isset( $_POST['attachment_id'] ) ? $_POST['attachment_id'] : 0;

			check_ajax_referer( "rwmb-attach-file_{$field_id}" );

			add_post_meta( $post_id, $field_id, $attachment_id, false );

			RW_Meta_Box::ajax_response( self::file_html( $attachment_id ), 'success' );
		}


		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			$i18n_title  = apply_filters( 'rwmb_file_advanced_select_string', _x( 'Select Files', 'file upload', 'mightymag-admin' ), $field );
			$attach_nonce = wp_create_nonce( "rwmb-attach-file_{$field['id']}" );

			// Uploaded files
			$html = self::get_uploaded_files( $meta, $field );

			// Show form upload
			$classes = array( 'button', 'rwmb-file-advanced-upload', 'hide-if-no-js', 'new-files' );
			if ( ! empty( $field['max_file_uploads'] ) && count( $meta ) >= (int) $field['max_file_uploads'] )
				$classes[] = 'hidden';

			$classes = implode( ' ', $classes );
			$html .= "<a href='#' class='{$classes}' data-attach_file_nonce={$attach_nonce}>{$i18n_title}</a>";

			return $html;
		}

		/**
		 * Get field value
		 * It's the combination of new (uploaded) images and saved images
		 *
		 * @param array $new
		 * @param array $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return array|mixed
		 */
		static function value( $new, $old, $post_id, $field )
		{
			$new = (array) $new;
			return array_unique( array_merge( $old, $new ) );
		}
	}
}
