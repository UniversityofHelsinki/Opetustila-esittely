<?php

/**
 * A template for personal account settings file. Copy and/or rename
 * this file into 'drush-alias-settings.php' and fill in your personal
 * account name(s).
 * 
 * 'drush-alias-settings.php' should contain personal account name(s) for
 * University of Helsinki Helpdesk development and production
 * servers.
 * 
 * 'drush-alias-settings.php' is used by uh-helpdesk.aliases.drushrc.php when
 * dynamically setting up drush aliases for development and production.
 *
 * Make sure you have a working ssh-key on the target server. Drush aliases
 * won't work without.
 * 
 * 'drush-alias-settings.php' should never end up in the git repository.
 */

// Add your personal account login here.
$remote_account_dev = '';
$remote_account_prod = $remote_account_dev;

