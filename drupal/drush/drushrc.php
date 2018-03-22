<?php
if (file_exists('/etc/drush/drushrc.php')) {
  require '/etc/drush/drushrc.php';
}

// I dont like vi.
// This matters when config edit needs to be refreshed in a handy way:
//   lando drush cedit migrate_plus.migration.optime_integration
// This doesnt work with drush 9. Do this in drush.yml instead.
$options['editor'] = 'nano';
$options['uri'] = "http://tilat.lndo.site";
