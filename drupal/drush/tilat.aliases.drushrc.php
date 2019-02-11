<?php
// If the .vagrant folder exists find the ssh key for the virtual machine
if (file_exists(drush_server_home() . '/.vagrant.d')) {
  $home = drush_server_home();
  // Solve the key file to use
  $path = explode('/', dirname(__FILE__));
  array_pop($path);
  array_pop($path);
  $path[] = '.vagrant';
  $path = implode('/', $path);
  // Check that the folder actually exists.
  if (file_exists($path)) {
    $key = shell_exec('find ' . $path . ' -iname private_key');
    if (!$key) {
      $key = $home . '/.vagrant.d/insecure_private_key';
    }
    $key = rtrim($key);
  }
  else {
    $key = "";
  }
} else {
  // .vagrant directory doesn't exist, just use empty key
  $key = "";
}

$aliases['local'] = array(
  'parent' => '@parent',
  'site' => 'tilat',
  'env' => 'vagrant',
  'root' => '/vagrant/drupal/current',
  'remote-host' => 'local.tilat.fi',
  'remote-user' => 'vagrant',
  'ssh-options' => '-i ' . $key,
);

// Fetch personal remote account settings. This should give us
// $remote_account_dev and $remote_account_prod variables.
include dirname(__FILE__) . '/drush-alias-settings.php';

// Develop.
if (!empty($remote_account_dev)) {
  $aliases['develop'] = array(
    'uri' => 'opetustila-test.it.helsinki.fi',
    'root' => '/var/www/opetustila-test.it.helsinki.fi/current',
    'remote-host' => 'opetustila-test.it.helsinki.fi',
    'remote-user' => $remote_account_dev,
    'path-aliases' => array('%dump-dir' => '/home/' . $remote_account_dev),
  );
}

// Stage.
if (!empty($remote_account_dev)) {
  $aliases['stage'] = array(
    'uri' => 'opetustila-staging.it.helsinki.fi',
    'root' => '/var/www/opetustila-staging.it.helsinki.fi/current',
    'remote-host' => 'opetustila-staging.it.helsinki.fi',
    'remote-user' => $remote_account_dev,
    'path-aliases' => array('%dump-dir' => '/home/' . $remote_account_dev),
  );
}

// Production.
if (!empty($remote_account_prod)) {
  $aliases['production'] = array(
    'uri' => 'tilavaraus.helsinki.fi',
    'root' => '/var/www/tilavaraus.helsinki.fi/current',
    'remote-host' => 'tilavaraus.helsinki.fi',
    'remote-user' => $remote_account_prod,
    'path-aliases' => array('%dump-dir' => '/home/' . $remote_account_prod),
  );
}
