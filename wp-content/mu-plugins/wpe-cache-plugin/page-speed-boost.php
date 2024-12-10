<?php

declare(strict_types=1);
namespace wpengine\cache_plugin;

\wpengine\cache_plugin\check_security();

class PageSpeedBoost {
	private static $instance = null;

	public function purge_cache() {
		if ( $this->is_page_speed_boost_installed() ) {
			if ( function_exists( 'nitropack_sdk_invalidate' ) ) {
				return nitropack_sdk_invalidate( null, null, 'Manual invalidation of all pages by PSB' );
			}
		}

		return false;
	}

	public function is_page_speed_boost_installed() {
		if ( ! $this->file_exists( WP_PLUGIN_DIR . '/nitropack' ) ) {
			return false;
		}

		if ( ! $this->function_exists( 'get_nitropack' ) ) {
			return false;
		}

		$nitropack = $this->get_nitropack();
		if ( ! method_exists( $nitropack, 'getDistribution' ) ) {
			return false;
		}

		return 'oneclick' === $nitropack->getDistribution();
	}

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new PageSpeedBoost();
		}

		return self::$instance;
	}

	public function file_exists( $file ) {
		return file_exists( $file );
	}

	public function function_exists( $file ) {
		return function_exists( $file );
	}

	public function get_nitropack() {
		return get_nitropack();
	}
}
