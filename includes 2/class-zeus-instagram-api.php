<?php
/**
 * Instagram API
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Zeus_Instagram_API {

	/**
	 * @var Zeus_Instagram_API The reference to *Singleton* instance of this class
	 */
	private static $instance;

	/**
	 * Returns the *Singleton* instance of this class.
	 *
	 * @return Zeus_Instagram_API The *Singleton* instance.
	 */
	public static function getInstance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Start things up
	 */
	public function __construct() {
		// delete cache
		add_action( 'save_post'   , array( $this, 'delete_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_cache' ) );
	}

	/**
	 * Get media data
	 *
	 * @param $number int    Number of images to retrieve
	 *
	 * @return array|bool Array of tweets or false if method fails
	 */
	public function get_media( $access_token, $number, $id ) {

		$key        = 'zeus_instagram_media_transient_' . $id; // transient name
		$expiration = 60 * 60 * 24; // 24 hours

		// Get any existing copy of our transient data
		if ( false === ( $result = get_transient( $key ) ) ) {

			// Fetch data
			$response = wp_remote_get( sprintf( 'https://api.instagram.com/v1/users/self/media/recent/?access_token=%s&count=%s', $access_token, $number ) );

			// Check for errors
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				return false;
			}

			// Retrieves the body of an already retrieved HTTP request then
			// transform the JSON string into a PHP array
			$data = json_decode( wp_remote_retrieve_body( $response ) );

			// Set empty variable
			$result = array();

			foreach ( $data->data as $item ) {

				$result[] = array(

					// Type
					'type'                 => $item->type,
					'id'                   => $item->id,

					// Images
					'img_thumbnail'        => $item->images->thumbnail->url,
					'img_thumbnail_width'  => $item->images->thumbnail->width,
					'img_thumbnail_height' => $item->images->thumbnail->height,
					'img_low_res'          => $item->images->low_resolution->url,
					'img_low_res_width'    => $item->images->low_resolution->width,
					'img_low_res_height'   => $item->images->low_resolution->height,
					'img_std_res'          => $item->images->standard_resolution->url,
					'img_std_res_width'    => $item->images->standard_resolution->width,
					'img_std_res_height'   => $item->images->standard_resolution->height,

					// Videos
					'vid_low_res'          => $item->low_resolution->url,
					'vid_std_res'          => $item->standard_resolution->url,

					// Details
					'url'                  => $item->link,
					'caption'              => $item->caption->text,
					'comments'             => $item->comments->count,
					'likes'                => $item->likes->count,

					// User
					'username'             => $item->user->username,
					'picture'              => $item->user->profile_picture,
					'userid'               => $item->user->id,

					// Location
					'location'             => $item->location->name,

				);

			}

			$result = array( 'data' => $result );

			// It wasn't there, so regenerate the data and save the transient
			set_transient( $key, $result, $expiration );

		}

		// Return the result
		return $result;
	}

	/**
	 * Get user info
	 *
	 * @return array|bool Array of tweets or false if method fails
	 */
	public function get_infos( $access_token, $id ) {

		$key        = 'zeus_instagram_info_transient_' . $id; // transient name
		$expiration = 60 * 60 * 24; // 24 hours

		// Get any existing copy of our transient data
		if ( false === ( $result = get_transient( $key ) ) ) {

			// Fetch data
			$response = wp_remote_get( sprintf( 'https://api.instagram.com/v1/users/self/?access_token=%s', $access_token ) );

			// Check for errors
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				return false;
			}

			// Retrieves the body of an already retrieved HTTP request then
			// transform the JSON string into a PHP array
			$data = json_decode( wp_remote_retrieve_body( $response ) );

			// Set empty variable
			$result = array();

			foreach ( $data as $item ) {

				$result[] = array(
					'id' 			=> $item->id,
					'username'  	=> $item->username,
					'avatar'  		=> $item->profile_picture,
					'name'  		=> $item->full_name,
					'bio'  			=> $item->bio,
					'website'  		=> $item->website,
					'posts'  		=> $item->counts->media,
					'follows'  		=> $item->counts->follows,
					'followed_by'  	=> $item->counts->followed_by,
				);

			}

			$result = array( 'data' => $result );

			// It wasn't there, so regenerate the data and save the transient
			set_transient( $key, $result, $expiration );

		}

		// Return the result
		return $result;
	}

	/**
	 * Delete cache
	 */
	public static function delete_cache() {
		global $wpdb;

		$prefix 	= esc_sql( 'zeus_instagram_' );
		$options 	= $wpdb->options;
		$t 			= esc_sql( "_transient_timeout_$prefix%" );
		$sql 		= $wpdb->prepare( "SELECT option_name FROM $options WHERE option_name LIKE '%s'", $t );
		$transients = $wpdb->get_col( $sql );

		// For each transient...
		foreach( $transients as $transient ) {

			// Strip away the WordPress prefix in order to arrive at the transient key.
			$key = str_replace( '_transient_timeout_', '', $transient );

			// Now that we have the key, use WordPress core to the delete the transient.
			delete_transient( $key );

		}
	}

}
