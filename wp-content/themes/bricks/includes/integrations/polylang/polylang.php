<?php
namespace Bricks\Integrations\Polylang;

use Bricks\Elements;
use Bricks\Database;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Polylang {
	public static $is_active = false;

	public function __construct() {
		self::$is_active = class_exists( 'Polylang' );

		if ( ! self::$is_active ) {
			return;
		}

		add_action( 'init', [ $this, 'init_elements' ] );

		add_filter( 'bricks/helpers/get_posts_args', [ $this, 'polylang_get_posts_args' ] );
		add_filter( 'bricks/ajax/get_pages_args', [ $this, 'polylang_get_posts_args' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );

		add_filter( 'pll_copy_post_metas', [ $this, 'copy_bricks_post_metas' ], 10, 3 );

		add_filter( 'bricks/search_form/home_url', [ $this, 'modify_search_form_home_url' ] );

		add_filter( 'bricks/builder/post_title', [ $this, 'add_langugage_to_post_title' ], 10, 2 );

		// Add language code to term name (@since 1.11)
		add_filter( 'bricks/builder/term_name', [ $this, 'add_language_to_term_name' ], 10, 3 );

		// Add language parameter to query args (@since 1.9.9)
		add_filter( 'bricks/posts/query_vars', [ $this, 'add_language_query_var' ], 100, 3 );
		add_filter( 'bricks/get_templates/query_vars', [ $this, 'add_template_language_query_var' ], 100 );
		add_filter( 'bricks/get_templates_query/cache_key', [ $this, 'add_template_language_cache_key' ] );

		// Add language code to populate correct export template link (@since 1.10)
		add_filter( 'bricks/export_template_args', [ $this, 'add_export_template_arg' ], 10, 2 );
	}

	/**
	 * Add language code to export template args
	 *
	 * @since 1.10
	 */
	public function add_export_template_arg( $args, $post_id ) {
		$post_language = self::get_post_language_code( $post_id );

		if ( ! empty( $post_language ) ) {
			$args['lang'] = $post_language;
		}

		return $args;
	}

	/**
	 * Add language query var to cache key to avoid cache conflicts
	 *
	 * @since 1.9.9
	 */
	public function add_template_language_cache_key( $cache_key ) {
		// Retrieve the current language on page load
		$current_lang = self::get_current_language();

		// Use Database::$page_data['language'] if set (API request)
		if ( isset( Database::$page_data['language'] ) && ! empty( Database::$page_data['language'] ) ) {
			$current_lang = sanitize_key( Database::$page_data['language'] );
		}

		$cache_key .= '_' . $current_lang;

		return $cache_key;
	}

	/**
	 * Add language query var when getting templates
	 *
	 * @since 1.9.9
	 */
	public function add_template_language_query_var( $args ) {
		// Check if the current language is set (@since 1.9.9) and the post type is translated (@since 1.11.1)
		if ( ! empty( Database::$page_data['language'] ) &&
			function_exists( 'pll_is_translated_post_type' ) &&
			pll_is_translated_post_type( BRICKS_DB_TEMPLATE_SLUG )
		) {
			$current_lang = sanitize_key( Database::$page_data['language'] );
			// Set the language query var
			$args['lang'] = $current_lang;
		}

		return $args;
	}

	/**
	 * Add language query var
	 *
	 * @since 1.9.9
	 */
	public function add_language_query_var( $query_vars, $settings, $element_id ) {
		if ( ! empty( Database::$page_data['language'] ) ) {
			$current_lang = sanitize_key( Database::$page_data['language'] );

			// Whether to not set the language query var if the post type is not translated
			if ( isset( $query_vars['post_type'] ) && function_exists( 'pll_is_translated_post_type' ) ) {
				$post_type               = $query_vars['post_type'];
				$is_translated_post_type = true;

				// Polylang function to check if a post type is translated
				$check_is_translated_post_type = function( $pt ) {
					return pll_is_translated_post_type( $pt );
				};

				if ( is_array( $post_type ) ) {
					// Multiple post types are queried, as long as one of them is not translated, do not set the language query var as no way to determine the language
					foreach ( $post_type as $pt ) {
						if ( ! $check_is_translated_post_type( $pt ) ) {
							$is_translated_post_type = false;
							break;
						}
					}
				} else {
					$is_translated_post_type = $check_is_translated_post_type( $post_type );
				}

				if ( ! $is_translated_post_type ) {
					// Post type is not translated, so do not set the language query var
					$current_lang = '';
				}
			}

			// Set the language query var
			$query_vars['lang'] = $current_lang;
		}

		return $query_vars;
	}

	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'bricks-polylang', BRICKS_URL_ASSETS . 'css/integrations/polylang.min.css', [ 'bricks-frontend' ], filemtime( BRICKS_PATH_ASSETS . 'css/integrations/polylang.min.css' ) );
	}

	/**
	 * Copy Bricks' post metas when duplicating a post
	 *
	 * @since 1.9.1
	 */
	public function copy_bricks_post_metas( $metas, $sync, $original_post_id ) {
		// Return: Do not copy metas when syncing (let Polylang handle it)
		if ( $sync ) {
			return $metas;
		}

		// Return: Do not copy Bricks' metas when the post is not rendered with Bricks
		if ( \Bricks\Helpers::get_editor_mode( $original_post_id ) !== 'bricks' ) {
			return $metas;
		}

		$meta_keys_to_check = [
			BRICKS_DB_TEMPLATE_TYPE,
			BRICKS_DB_EDITOR_MODE,
			BRICKS_DB_PAGE_SETTINGS,
			BRICKS_DB_TEMPLATE_SETTINGS,
		];

		$template_type = get_post_meta( $original_post_id, BRICKS_DB_TEMPLATE_TYPE, true );

		if ( $template_type === 'header' ) {
			$meta_keys_to_check[] = BRICKS_DB_PAGE_HEADER;
		} elseif ( $template_type === 'footer' ) {
			$meta_keys_to_check[] = BRICKS_DB_PAGE_FOOTER;
		} else {
			$meta_keys_to_check[] = BRICKS_DB_PAGE_CONTENT;
		}

		$additional_metas = [];

		// Add metas only if they exist
		foreach ( $meta_keys_to_check as $meta_key_to_check ) {
			if ( metadata_exists( 'post', $original_post_id, $meta_key_to_check ) ) {
				$additional_metas[] = $meta_key_to_check;
			}
		}

		return array_merge( $metas, $additional_metas );
	}

	/**
	 * Init Polylang elements
	 *
	 * polylang-language-switcher
	 */
	public function init_elements() {
		$polylang_elements = [
			'polylang-language-switcher',
		];

		foreach ( $polylang_elements as $element_name ) {
			$polylang_element_file = BRICKS_PATH . "includes/integrations/polylang/elements/$element_name.php";

			// Get the class name from the element name
			$class_name = str_replace( '-', '_', $element_name );
			$class_name = ucwords( $class_name, '_' );
			$class_name = "Bricks\\$class_name";

			if ( is_readable( $polylang_element_file ) ) {
				Elements::register_element( $polylang_element_file, $element_name, $class_name );
			}
		}
	}

	/**
	 * Set the query arg to get all the posts/pages languages
	 *
	 * @param array $query_args
	 * @return array
	 */
	public function polylang_get_posts_args( $query_args ) {
		if ( ! isset( $query_args['lang'] ) ) {
			$query_args['lang'] = '';
		}

		return $query_args;
	}

	/**
	 * Modify the search form action URL to use the home URL
	 *
	 * @param string $url
	 * @return string
	 *
	 * @since 1.9.4
	 */
	public function modify_search_form_home_url( $url ) {
		// Check if Polylang is active
		if ( function_exists( 'pll_current_language' ) ) {
			// Get the current language slug
			$current_lang_slug = pll_current_language( 'slug' );

			// Append the language slug to the base home URL (if it's not the default language)
			$default_lang = pll_default_language( 'slug' );
			if ( $current_lang_slug !== $default_lang ) {
				return trailingslashit( home_url() ) . $current_lang_slug;
			}
		}

		// Return the original URL if Polylang is not active or if it's the default language
		return $url;
	}

	/**
	 * Add language code to post title
	 *
	 * @param string $title   The original title of the page.
	 * @param int    $page_id The ID of the page.
	 * @return string The modified title with the language suffix.
	 *
	 * @since 1.9.4
	 */
	public function add_langugage_to_post_title( $title, $page_id ) {
		\Bricks\Ajax::verify_nonce( 'bricks-nonce-builder' );

		if ( isset( $_GET['addLanguageToPostTitle'] ) ) {
			$language_code = self::get_post_language_code( $page_id );
			$language_code = ! empty( $language_code ) ? strtoupper( $language_code ) : '';

			if ( ! empty( $language_code ) ) {
				return "[$language_code] $title";
			}
		}

		// Return the original title if conditions are not met
		return $title;
	}


	/**
	 * Add language code to term name
	 *
	 * @param string $name    The original name of the term.
	 * @param int    $term_id The ID of the term.
	 * @param string $taxonomy The taxonomy of the term.
	 * @return string The modified name with the language suffix.
	 *
	 * @since 1.11
	 */
	public function add_language_to_term_name( $name, $term_id, $taxonomy ) {
		\Bricks\Ajax::verify_nonce( 'bricks-nonce-builder' );

		if ( ! isset( $_GET['addLanguageToTermName'] ) || ! filter_var( $_GET['addLanguageToTermName'], FILTER_VALIDATE_BOOLEAN ) ) {
				return $name;
		}

		if ( ! function_exists( 'pll_get_term_language' ) ) {
			return $name;
		}

		$term_id = absint( $term_id );

		if ( $term_id === 0 || ! term_exists( $term_id, $taxonomy ) ) {
			return $name;
		}

		$language_code = pll_get_term_language( $term_id );
		$language_code = ! empty( $language_code ) ? strtoupper( sanitize_key( $language_code ) ) : '';

		if ( ! empty( $language_code ) ) {
			return '[' . $language_code . '] ' . $name;
		}

		return $name;
	}

	/**
	 * Get the language code of a post
	 *
	 * @since 1.10
	 */
	public static function get_post_language_code( $post_id ) {
		return function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post_id ) : '';
	}

	/**
	 * Get the current language code in Polylang.
	 *
	 * @return string|null The current language code or null if not set.
	 *
	 * @since 1.9.9
	 */
	public static function get_current_language() {
		if ( function_exists( 'pll_current_language' ) ) {
			return \pll_current_language(); // phpcs:ignore
		}

		return null;
	}
}
