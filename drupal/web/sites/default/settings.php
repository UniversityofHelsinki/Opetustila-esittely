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

$env = getenv('WKV_SITE_ENV');
switch ($env) {
  case 'production':
    $settings['simple_environment_indicator'] = '#d4000f Production';
    break;

  case 'dev':
    $settings['simple_environment_indicator'] = '#004984 Development';
    break;

  case 'stage':
    $settings['simple_environment_indicator'] = '#e56716 Stage';
    break;

  case 'local':
    $settings['simple_environment_indicator'] = '#88b700 Local';
    break;
}
/**
 * Location of the site configuration files.
 */
$config_directories = array(
  CONFIG_SYNC_DIRECTORY => '../sync',
);

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
#$config['migrate_plus.migration.optime_integration']['source']['urls'] =
#  'https://esbmt1.it.helsinki.fi/optime/locations/?fromTimestamp=1';

$import_period = time() - (168 * 3600); // Import last 7 days of changes.
  $config['migrate_plus.migration.optime_integration']['source']['urls'] =
    'https://esbmt1.it.helsinki.fi/optime/locations/?fromTimestamp=' . $import_period;


// To have optime integration running in any environment, we need this in crontab:
# Fetch	Optime data every 25mins. This interval	could be made much smaller if/when the importer	contains a dynamic
# time filter, to limit	the results to items that have updated within a	short timeframe	(such as last import time or last 24h).
# */25 * * * * cd /var/www/opetustila-test.it.helsinki.fi/current/web/sites/default; /usr/lib/composer/vendor/bin/drush mim optime_integration --update

// Fix warning on Drupal status page.
$settings['trusted_host_patterns'] = array(
'^tilat\.lndo\.site$',
'^.*\.helsinki\.fi$',
'^127\.0\.0\.1$',
);


/**
 * Environment specific override configuration, if available.
 */
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}

$settings['install_profile'] = 'config_installer';
