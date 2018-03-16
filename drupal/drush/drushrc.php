<?php
if (file_exists('/etc/drush/drushrc.php')) {
  require '/etc/drush/drushrc.php';
}

// I dont like vi.
// This matters when config edit needs to be refreshed in a handy way:
//   lando drush cedit migrate_plus.migration.optime_integration
$options['editor'] = 'nano';
