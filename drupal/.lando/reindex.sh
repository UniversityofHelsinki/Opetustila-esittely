#!/bin/sh
set -exu

# Reindex search indices
cd /app/web
drush --root=/app/web cr
drush --root=/app/web sapi-c
drush --root=/app/web sapi-i
