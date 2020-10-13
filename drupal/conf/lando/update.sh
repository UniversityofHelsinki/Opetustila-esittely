#!/bin/bash
set -exu

# Update local database.
drush @tilat.local updb -y

# Enable development modules.
drush @tilat.local en update -y

# Clear caches.
drush @tilat.local cc drush
drush @tilat.local cr -y

# Generate login URL.
drush @tilat.local uli
