<?php

declare(strict_types=1);

namespace wpengine\cache_plugin;

require_once __DIR__ . '/security/security-checks.php';
require_once __DIR__ . '/wpe-common-adapter.php';
require_once __DIR__ . '/logging-trait.php';

\wpengine\cache_plugin\check_security();

class ClearAllCachesController {

	use CachePluginLoggingTrait;

	private $wpe_common_adapter;
	private $cache_db_settings;
	private $date_time_helper;
	private $page_speed_boost;

	public function __construct( $wpe_common_adapter, $cache_db_settings, $date_time_helper, $page_speed_boost ) {
		$this->wpe_common_adapter = $wpe_common_adapter;
		$this->cache_db_settings  = $cache_db_settings;
		$this->date_time_helper   = $date_time_helper;
		$this->page_speed_boost   = $page_speed_boost;
	}

	public function rate_limit_status() {
		try {
			return \rest_ensure_response(
				array(
					'success'            => true,
					'rate_limit_expired' => true,
				)
			);
		} catch ( \Exception $e ) {
			$this->log_error( 'Caught exception: ' . $e->getMessage() );
			return \rest_ensure_response(
				array(
					'success' => false,
				)
			);
		}
	}

	public function clear_all_caches() {
		try {
			$this->wpe_common_adapter->purge_memcached();
			$this->wpe_common_adapter->purge_varnish_cache();
			$this->wpe_common_adapter->purge_ges_advanced_network_cache();
			$this->page_speed_boost->purge_cache();

			$this->log_info( 'event=clear-all-cache' );
			$cleared_at_time = $this->cache_db_settings->update_cache_last_cleared();

			return rest_ensure_response(
				array(
					'success'      => true,
					'time_cleared' => $cleared_at_time,
				)
			);
		} catch ( \Exception $e ) {
			$this->log_error( 'Caught exception: ' . $e->getMessage() );
			$cleared_at_time = $this->cache_db_settings->update_cache_last_error();

			return rest_ensure_response(
				array(
					'success'       => false,
					'last_error_at' => $cleared_at_time,
				)
			);
		}
	}
}
