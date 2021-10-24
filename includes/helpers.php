<?php
/**
 * Helpers functions
 *
 * @package Zeus
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get post types
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_get_available_post_types' ) ) {

	function zeus_get_available_post_types() {

		$post_type_args = array(
			// Default is the value $public.
			'show_in_nav_menus' => true,
		);

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
		}

		$post_types = get_post_types( $post_type_args, 'objects' );

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		foreach ( $post_types as $post_type => $object ) {
			$result[ $post_type ] = $object->label;
		}

		return $result;
	}
}

/**
 * Get image sizes
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_get_img_sizes' ) ) {

	function zeus_get_img_sizes() {

		global $_wp_additional_image_sizes;

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		$image_sizes = array();

		foreach ( $sizes as $size_key => $size_attributes ) {
			$image_sizes[ $size_key ] = ucwords( str_replace( '_', ' ', $size_key ) ) . sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
		}

		$image_sizes['full'] = _x( 'Full', 'Image Size Control', 'zeus-elementor' );

		return $image_sizes;
	}
}

/**
 * Get title tags
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_get_available_tags' ) ) {

	function zeus_get_available_tags() {

		$tags = array(
			'h1'   => __( 'H1', 'zeus-elementor' ),
			'h2'   => __( 'H2', 'zeus-elementor' ),
			'h3'   => __( 'H3', 'zeus-elementor' ),
			'h4'   => __( 'H4', 'zeus-elementor' ),
			'h5'   => __( 'H5', 'zeus-elementor' ),
			'h6'   => __( 'H6', 'zeus-elementor' ),
			'div'  => __( 'div', 'zeus-elementor' ),
			'span' => __( 'span', 'zeus-elementor' ),
			'p'    => __( 'p', 'zeus-elementor' ),
		);
		$tags = apply_filters( 'zeus_title_tags', $tags );

		return $tags;
	}
}

/**
 * Get available sidebars
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_get_available_sidebars' ) ) {

	function zeus_get_available_sidebars() {
		global $wp_registered_sidebars;

		$sidebars = array();

		if ( ! $wp_registered_sidebars ) {
			$sidebars['0'] = __( 'No sidebars were found', 'zeus-elementor' );
		} else {
			$sidebars['0'] = __( '-- Select --', 'zeus-elementor' );

			foreach ( $wp_registered_sidebars as $id => $sidebar ) {
				$sidebars[ $id ] = $sidebar['name'];
			}
		}

		return $sidebars;
	}
}

/**
 * Get available templates
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_get_available_templates' ) ) {

	function zeus_get_available_templates() {
		$templates = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'posts_per_page' => -1,
			)
		);

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		if ( ! empty( $templates ) && ! is_wp_error( $templates ) ) {
			foreach ( $templates as $item ) {
				$result[ $item->ID ] = $item->post_title;
			}
		}

		return $result;
	}
}

/**
 * Check if Advanced Custom Fields plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_acf_active' ) ) {

	function is_acf_active() {
		$return = false;

		if ( class_exists( 'acf' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Contact Form 7 plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_contact_form_7_active' ) ) {

	function is_contact_form_7_active() {
		$return = false;

		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WPForms plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_wpforms_active' ) ) {

	function is_wpforms_active() {
		$return = false;

		if ( class_exists( '\WPForms\WPForms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Gravity Forms plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_gravity_forms_active' ) ) {

	function is_gravity_forms_active() {
		$return = false;

		if ( class_exists( 'GFCommon' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Caldera Forms plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_caldera_forms_active' ) ) {

	function is_caldera_forms_active() {
		$return = false;

		if ( class_exists( 'Caldera_Forms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Ninja Forms plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_ninja_forms_active' ) ) {

	function is_ninja_forms_active() {
		$return = false;

		if ( class_exists( 'Ninja_Forms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WooCommerce plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {

	function is_woocommerce_active() {
		$return = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WPML String Translation plugin is active
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'is_wpml_string_translation_active' ) ) {

	function is_wpml_string_translation_active() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		return is_plugin_active( 'wpml-string-translation/plugin.php' );
	}
}

/**
 * Numbered Pagination
 *
 * @since   1.0.0
 * @link    https://codex.wordpress.org/Function_Reference/paginate_links
 */
if ( ! function_exists( 'zeus_pagination' ) ) {

	function zeus_pagination( $query = '', $echo = true ) {

		// Arrows with RTL support
		$prev_arrow = is_rtl() ? 'fas fa-angle-right' : 'fas fa-angle-left';
		$next_arrow = is_rtl() ? 'fas fa-angle-left' : 'fas fa-angle-right';

		// Get global $query
		if ( ! $query ) {
			global $wp_query;
			$query = $wp_query;
		}

		// Set vars
		$total = $query->max_num_pages;
		$big   = 999999999;

		// Display pagination if total var is greater then 1 ( current query is paginated )
		if ( $total > 1 ) {

			// Get current page
			if ( $current_page = get_query_var( 'paged' ) ) {
				$current_page = $current_page;
			} elseif ( $current_page = get_query_var( 'page' ) ) {
				$current_page = $current_page;
			} else {
				$current_page = 1;
			}

			// Get permalink structure
			if ( get_option( 'permalink_structure' ) ) {
				if ( is_page() ) {
					$format = 'page/%#%/';
				} else {
					$format = '/%#%/';
				}
			} else {
				$format = '&paged=%#%';
			}

			$args = apply_filters(
				'zeus_pagination_args',
				array(
					'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
					'format'    => $format,
					'current'   => max( 1, $current_page ),
					'total'     => $total,
					'mid_size'  => 3,
					'type'      => 'list',
					'prev_text' => '<span class="screen-reader-text">'. esc_attr__( 'Go to the previous page','zeus-elementor' ) .'</span><i class="'. $prev_arrow .'" aria-hidden="true"></i>',
					'next_text' => '<span class="screen-reader-text">'. esc_attr__( 'Go to the next page','zeus-elementor' ) .'</span><i class="'. $next_arrow .'" aria-hidden="true"></i>',
				)
			);

			// Output pagination
			if ( $echo ) {
				echo '<div class="zeus-pagination">' . paginate_links( $args ) . '</div>';
			} else {
				return '<div class="zeus-pagination">' . paginate_links( $args ) . '</div>';
			}
		}
	}
}

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since   1.0.0
 * @link    http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'zeus_excerpt' ) ) {

	function zeus_excerpt( $length = 15 ) {

		// Get global post
		global $post;

		// Get post data
		$id      = $post->ID;
		$excerpt = $post->post_excerpt;
		$content = $post->post_content;

		// Display custom excerpt
		if ( $excerpt ) {
			$output = $excerpt;
		}

		// Check for more tag
		elseif ( strpos( $content, '<!--more-->' ) ) {
			$output = get_the_content( $excerpt );
		}

		// Generate auto excerpt
		else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length );
		}

		// Echo output
		echo wp_kses_post( $output );

	}
}

/**
 * Get all types of post
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_get_post_list' ) ) {

	function zeus_get_post_list( $post_type = 'any', $limit = -1, $search = '' ) {

		global $wpdb;
		$where = '';
		$data  = array();

		if ( -1 == $limit ) {
			$limit = '';
		} elseif ( 0 == $limit ) {
			$limit = 'limit 0,1';
		} else {
			$limit = $wpdb->prepare( ' limit 0,%d', esc_sql( $limit ) );
		}

		if ( 'any' === $post_type ) {
			$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );
			if ( empty( $in_search_post_types ) ) {
				$where .= ' AND 1=0 ';
			} else {
				$where .= " AND {$wpdb->posts}.post_type IN ('" . join(
					"', '",
					array_map( 'esc_sql', $in_search_post_types )
				) . "')";
			}
		} elseif ( ! empty( $post_type ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
		}

		if ( ! empty( $search ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
		}

		$query   = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
		$results = $wpdb->get_results( $query );
		if ( ! empty( $results ) ) {
			foreach ( $results as $row ) {
				$data[ $row->ID ] = $row->post_title;
			}
		}
		return $data;

	}
}

/**
 * Get all authors
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_get_authors_list' ) ) {

	function zeus_get_authors_list() {

		$users = get_users([
            'who' => 'authors',
            'has_published_posts' => true,
            'fields' => [
                'ID',
                'display_name',
            ],
        ]);

        if (!empty($users)) {
            return wp_list_pluck($users, 'display_name', 'ID');
        }

        return [];

	}
}

/**
 * Get Order By options
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_get_orderby_options' ) ) {

	function zeus_get_orderby_options() {

		$orderby = array(
            ''              => __( 'Default', 'zeus-elementor' ),
			'date'          => __( 'Date', 'zeus-elementor' ),
			'title'         => __( 'Title', 'zeus-elementor' ),
			'name'          => __( 'Name', 'zeus-elementor' ),
			'modified'      => __( 'Last Modified Date', 'zeus-elementor' ),
			'author'        => __( 'Author', 'zeus-elementor' ),
			'rand'          => __( 'Random', 'zeus-elementor' ),
			'ID'            => __( 'Post ID', 'zeus-elementor' ),
			'comment_count' => __( 'Comment Count', 'zeus-elementor' ),
			'menu_order'    => __( 'Menu Order', 'zeus-elementor' ),
        );

        return $orderby;

	}
}

/**
 * Ajax search
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_ajax_search' ) ) {

	function zeus_ajax_search() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'zeus' ) ) {
			wp_die();
		}

		$search    = sanitize_text_field( $_POST['search'] );
		$post_type = sanitize_text_field( $_POST['type'] );
		$args      = array(
			's'              => $search,
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => 5,
		);
		$query     = new WP_Query( $args );
		$output    = '';

		// Icons
		$icon      = '';

		if ( is_RTL() ) {
			$icon = 'left';
		} else {
			$icon = 'right';
		}

		if ( $query->have_posts() ) {

			$output .= '<ul>';

			while ( $query->have_posts() ) :
				$query->the_post();
				$output     .= '<li>';
					$output .= '<a href="' . get_permalink() . '" class="search-result-link">';

				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail(
						get_the_ID(),
						'thumbnail',
						array(
							'alt'      => get_the_title(),
							'itemprop' => 'image',
						)
					);
				}

						$output .= '<div class="result-title">' . get_the_title() . '</div>';
					$output     .= '</a>';
					$output     .= '</li>';
				endwhile;

			if ( $query->found_posts > 1 ) {
				$search_link = get_search_link( $search );

				if ( 'any' != $post_type ) {
					$search_link .= '?post_type='. $post_type;
				}

					$output .= '<li><a href="' . $search_link . '" class="all-results"><span>' . sprintf( esc_html__( 'View all %d results', 'zeus-elementor' ), $query->found_posts ) . '<i class="fas fa-long-arrow-alt-'. $icon .'"></i></span></a></li>';
			}
		} else {

			$output .= '<div class="zeus-no-search-results">';
			$output .= '<h6>' . esc_html__( 'No results', 'zeus-elementor' ) . '</h6>';
			$output .= '<p>' . esc_html__( 'No search results could be found, please try another search.', 'zeus-elementor' ) . '</p>';
			$output .= '</div>';

		}

		wp_reset_query();

		echo $output;

		die();

	}

	add_action( 'wp_ajax_zeus_ajax_search', 'zeus_ajax_search' );
	add_action( 'wp_ajax_nopriv_zeus_ajax_search', 'zeus_ajax_search' );

}

/**
 * Get MailChimp list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'zeus_mailchimp_lists' ) ) {

	function zeus_mailchimp_lists() {
		$lists = [];
		$api_key = get_option( 'zeus_mailchimp_api_key' );

        if (empty($api_key)) {
            return $lists;
        }

        $response = wp_remote_get('https://' . substr($api_key,
            strpos($api_key, '-') + 1) . '.api.mailchimp.com/3.0/lists/?fields=lists.id,lists.name&count=1000', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
            ],
        ]);

        if (!is_wp_error($response)) {
            $response = json_decode(wp_remote_retrieve_body($response));

            if (!empty($response) && !empty($response->lists)) {
                $lists[''] = __( 'Select One', 'zeus-elementor' );

                for ($i = 0; $i < count($response->lists); $i++) {
                    $lists[$response->lists[$i]->id] = $response->lists[$i]->name;
                }
            }
        }

        return $lists;
	}
}

/**
 * MailChimp Form
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_mc_form' ) ) {

	function zeus_mc_form() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'zeus' ) ) {
			wp_die();
		}

        $api_key = sanitize_text_field( $_POST['apiKey'] );
        $fname = sanitize_file_name( $_POST['firstname'] );
        $lname = sanitize_file_name( $_POST['lastname'] );

        $merge_fields = array(
            'FNAME' => ! empty( $fname ) ? $fname : '',
            'LNAME' => ! empty( $lname ) ? $lname : '',
        );

        $response = wp_remote_post(
            'https://' . substr( $api_key, strpos(
                $api_key,
                '-'
            ) + 1) . '.api.mailchimp.com/3.0/lists/' . sanitize_text_field( $_POST['listId'] ) . '/members/' . md5( strtolower( sanitize_email( $_POST['email'] ) ) ),
            [
                'method' => 'PUT',
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key ),
                ],
                'body' => json_encode( [
                    'email_address' => sanitize_email( $_POST['email'] ),
                    'status' => 'subscribed',
                    'merge_fields' => $merge_fields,
                ] ),
            ]
        );

        if ( ! is_wp_error( $response ) ) {
            $response = json_decode( wp_remote_retrieve_body( $response ) );

            if ( ! empty( $response ) ) {
                if ( $response->status == 'subscribed' ) {
                    wp_send_json( [
                        'status' => 'subscribed',
                    ] );
                } else {
                    wp_send_json( [
                        'status' => $response->title,
                    ] );
                }
            }
        }
	}

	add_action( 'wp_ajax_zeus_mc_form', 'zeus_mc_form' );
	add_action( 'wp_ajax_nopriv_zeus_mc_form', 'zeus_mc_form' );

}

/**
 * Body microdata
 * Used if header selected in the plugin settings
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_body_microdata' ) ) {

	function zeus_body_microdata() {
		$type = 'WebPage';

		if ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) {
			$type = 'Blog';
		}

		if ( is_search() ) {
			$type = 'SearchResultsPage';
		}

		$type = apply_filters( 'zeus_body_itemtype', $type );

		$data = sprintf(
			'itemtype="https://schema.org/%s" itemscope',
			esc_html( $type )
		);

		return apply_filters( 'zeus_body_microdata', $data );
	}

}

/**
 * Header Enabled
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_header_enabled' ) ) {

	function zeus_header_enabled() {
		$id = get_option( 'zeus_header' );
		$status = false;

		if ( ! empty( $id ) ) {
			$status = true;
		}

		return apply_filters( 'zeus_header_enabled', $status );
	}

}

/**
 * Footer Enabled
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_footer_enabled' ) ) {

	function zeus_footer_enabled() {
		$id = get_option( 'zeus_footer' );
		$status = false;

		if ( ! empty( $id ) ) {
			$status = true;
		}

		return apply_filters( 'zeus_footer_enabled', $status );
	}

}

/**
 * Header ID
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_header_id' ) ) {

	function zeus_header_id() {
		$id = get_option( 'zeus_header' );

        if ( '' === $id ) {
            $id = false;
        }

        return apply_filters( 'zeus_header_id', $id );
	}

}

/**
 * Footer ID
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_footer_id' ) ) {

	function zeus_footer_id() {
		$id = get_option( 'zeus_footer' );

        if ( '' === $id ) {
            $id = false;
        }

        return apply_filters( 'zeus_footer_id', $id );
	}

}

/**
 * Render Header
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_render_header' ) ) {

	function zeus_render_header() { ?>
		<header class="zeus-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
            <?php echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( zeus_header_id() ); ?>
        </header>
    <?php
	}

}

/**
 * Render Footer
 *
 * @since   1.0.0
 */
if ( ! function_exists( 'zeus_render_footer' ) ) {

	function zeus_render_footer() { ?>
		<footer class="zeus-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter" role="contentinfo">
            <?php echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( zeus_footer_id() ); ?>
        </footer>
    <?php
	}

}