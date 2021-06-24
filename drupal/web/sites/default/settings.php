<?php

/**
 * General settings.php for all environments.
 * You could use this to add general settings to be used for all environments.
 */

/**
 * Database settings (overridden per environment)
 */
$databases = [];
$databases['default']['default'] = [
  'database' => getenv('DB_NAME_DRUPAL'),
  'username' => getenv('DB_USER_DRUPAL'),
  'password' => getenv('DB_PASS_DRUPAL'),
  'prefix' => '',
  'host' => getenv('DB_HOST_DRUPAL'),
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
];

// CHANGE THIS.
$settings['hash_salt'] = 'some-hash-salt-please-change-this';

if ((isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on")
  || (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https")
  || (isset($_SERVER["HTTP_HTTPS"]) && $_SERVER["HTTP_HTTPS"] == "on")
) {
  $_SERVER["HTTPS"] = "on";

  // Tell Drupal we're using HTTPS (url() for one depends on this).
  $settings['https'] = TRUE;
}

// @codingStandardsIgnoreStart
if (isset($_SERVER['REMOTE_ADDR'])) {
  $settings['reverse_proxy'] = TRUE;
  $settings['reverse_proxy_addresses'] = [$_SERVER['REMOTE_ADDR']];
}
// @codingStandardsIgnoreEnd

if (!empty($_SERVER['SERVER_ADDR'])) {
  // This should return last section of IP, such as "198". (dont want/need to expose more info).
  //drupal_add_http_header('X-Webserver', end(explode('.', $_SERVER['SERVER_ADDR'])));
  $pcs = explode('.', $_SERVER['SERVER_ADDR']);
  header('X-Webserver: ' . end($pcs));
}

// Disallow configuration changes via UI by default.
$settings['config_readonly'] = TRUE;

// Some configurations changes we want to allow like menu items and
// configurations that are intentionally ignored with config_ignore.
$settings['config_readonly_whitelist_patterns'] = [
  'system.performance',
  'system.site',
  'system.menu.*',
  'core.menu.static_menu_link_overrides',
  'cookieconsent.settings',
];

// Allow submitting the taxonomy "Reset to alphabetical" confirmation form.
// There is no configuration match so we cannot use the whitelist above.
if (preg_match("/\/(.*)\/admin\/structure\/taxonomy\/manage(.*)reset/i", $_SERVER['REQUEST_URI'])) {
  $settings['config_readonly'] = FALSE;
}

// Command line (like drush) should allow configuration changes.
if (PHP_SAPI === 'cli') {
  $settings['config_readonly'] = FALSE;
}

// Be sure to have config_split.local disabled by default.
$config['config_split.config_split.local']['status'] = FALSE;

$env = getenv('WKV_SITE_ENV');
global $base_url;

switch ($env) {
  case 'prod':


    // Warden settings.
    // Shared secret between the site and Warden server.
    $config['warden.settings']['warden_token'] = getenv('WARDEN_TOKEN');
    // Location of your Warden server. No trailing slash.
    $config['warden.settings']['warden_server_host_path'] = 'https://warden.wunder.io';
    // Allow external callbacks to the site. When set to FALSE pressing refresh site
    // data in Warden will not work.
    $config['warden.settings']['warden_allow_requests'] = TRUE;
    // Basic HTTP authorization credentials.
    $config['warden.settings']['warden_http_username'] = 'warden';
    $config['warden.settings']['warden_http_password'] = 'wunder';
    // IP address of the Warden server. Only these IP addresses will be allowed to
    // make callback # requests.
    $config['warden.settings']['warden_public_allow_ips'] = '35.228.188.78,35.228.81.50';
    // Define module locations.
    $config['warden.settings']['warden_preg_match_custom'] = '{^modules\/custom\/*}';
    $config['warden.settings']['warden_preg_match_contrib'] = '{^modules\/contrib\/*}';
    $config['warden.settings']['warden_match_contrib'] = TRUE;

    $settings['simple_environment_indicator'] = '#d4000f Production';
    $base_url = "https://tilavaraus.helsinki.fi";
    // Sitemap settings override.
    $config['simple_sitemap.settings']['base_url'] = 'https://tilavaraus.helsinki.fi';
    // GTM settings override.
    $config['google_tag.container.tilavaraus.helsinki.fi']['environment_id'] = 'env-1';
    $config['google_tag.container.tilavaraus.helsinki.fi']['environment_token'] = 'RN8MQBhEX_4ifvbbJYqPnw';
    // Warden settings.
    // Shared security token between the site and Warden server.
    $config['warden.settings']['warden_token'] = getenv('WARDEN_TOKEN');
    // Location of the Warden server, no trailing slash.
    $config['warden.settings']['warden_server_host_path'] = 'https://warden.wunder.io';
    // Allow refreshing site data from the Warden server.
    $config['warden.settings']['warden_allow_requests'] = TRUE;
    // Basic HTTP authorization credentials.
    $config['warden.settings']['warden_http_username'] = 'warden';
    $config['warden.settings']['warden_http_password'] = 'wunder';
    // IP addresses of the Warden server allowed to make callback requests.
    $config['warden.settings']['warden_public_allow_ips'] = '35.228.188.78,35.228.81.50';
    // Define the module locations.
    $config['warden.settings']['warden_preg_match_custom'] = '{^modules\/custom\/*}';
    $config['warden.settings']['warden_preg_match_contrib'] = '{^modules\/contrib\/*}';
    $config['warden.settings']['warden_match_contrib'] = TRUE;
    break;

  case 'dev':
    $settings['simple_environment_indicator'] = '#004984 Development';
    $base_url = "https://opetustila-test.it.helsinki.fi";
    // Disable config_readonly on dev.
    $settings['config_readonly'] = FALSE;
    // Enable config_split.dev on dev.
    $config['config_split.config_split.local']['status'] = TRUE;
    // Sitemap settings override.
    $config['simple_sitemap.settings']['base_url'] = 'https://opetustila-test.it.helsinki.fi';
    break;

  case 'stage':
    $settings['simple_environment_indicator'] = '#e56716 Stage';
    $base_url = "https://opetustila-staging.it.helsinki.fi";
    // Sitemap settings override.
    $config['simple_sitemap.settings']['base_url'] = 'https://opetustila-staging.it.helsinki.fi';
    break;

  case 'local':
    $settings['simple_environment_indicator'] = '#88b700 Local';
    $base_url = "https://local.tilat.fi";
    // Disable config_readonly on local.
    $settings['config_readonly'] = FALSE;
    // Enable config_split.dev on local.
    $config['config_split.config_split.local']['status'] = TRUE;
    // Sitemap settings override.
    $config['simple_sitemap.settings']['base_url'] = 'https://local.tilat.fi';
    break;

  case 'lando':
    $settings['simple_environment_indicator'] = '#88b700 Local';
    $base_url = "https://tilat.lndo.site";
    // Disable config_readonly on local.
    $settings['config_readonly'] = FALSE;
    // Enable config_split.dev on local.
    $config['config_split.config_split.local']['status'] = TRUE;
    // Sitemap settings override.
    $config['simple_sitemap.settings']['base_url'] = 'https://tilat.lndo.site';
    // Skip file system permissions hardening in local development with Lando.
    $settings['skip_permissions_hardening'] = TRUE;
    // File proxy origin site.
    $config['stage_file_proxy.settings']['origin'] = 'https://tilavaraus.helsinki.fi';
    break;
}

/**
 * Location of the site configuration files.
 */
$settings['config_sync_directory'] = '../sync';

/**
 * Exclude selected modules from configuration.
 */
$settings['config_exclude_modules'] = ['devel', 'stage_file_proxy', 'warden'];

/**
 * Access control for update.php script.
 */
$settings['update_free_access'] = FALSE;

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';


// Override optime migration url per environment. This can be put in settings.local.php
// $config['migrate_plus.migration.optime_integration']['source']['urls'] = 'https://helpdesk.it.helsinki.fi/sites/default/files/testdata/test_full.json';

// Override optime migration url.
// dev and prod urls point to:
//  https://esbmt2.it.helsinki.fi/devel/optime/locations/?fromTimestamp=1 <-- DEV
//  https://esbmt1.it.helsinki.fi/optime/locations/?fromTimestamp=1 <-- PROD
// It can also have a a date filter, including only the nodes that have changed after
// a specific UNIX timestamp.
//$config['migrate_plus.migration.optime_integration']['source']['urls'] =
//  'https://esbmt1.it.helsinki.fi/optime/locations/?fromTimestamp=1';

// $import_period = time() - (72 * 3600); // Import last 3 days of changes
//   $config['migrate_plus.migration.optime_integration']['source']['urls'] =
//    'https://{optime-url}?fromTimestamp=' . $import_period;


// To have optime integration running in any environment, we need this in crontab:
# Fetch	Optime data every 25mins. This interval	could be made much smaller if/when the importer	contains a dynamic
# time filter, to limit	the results to items that have updated within a	short timeframe	(such as last import time or last 24h).
# */25 * * * * cd /var/www/opetustila-test.it.helsinki.fi/current/web/sites/default; /usr/lib/composer/vendor/bin/drush mim optime_integration --update

// Fix warning on Drupal status page.
$settings['trusted_host_patterns'] = [
  '^local\.tilat\.fi$',
  '^tilat\.lndo\.site$',
  '^.*\.helsinki\.fi$',
  '^127\.0\.0\.1$',
];

/**
 * local setup for switching between optime apis used.
 */

$settings['optime-url'] = getenv("OPTIME_URL");
$settings['optime-api-key'] = getenv("OPTIME_API_KEY");
/**
 * Environment specific override configuration, if available.
 */
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
