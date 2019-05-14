<?php

namespace Drupal\migrate_optime_json\Plugin\migrate\source;

use Drupal\migrate_plus\Plugin\migrate\source\Url;
use Drupal\migrate\Plugin\MigrationInterface;

/**
 * Source plugin for retrieving data via URLs.
 *
 * @MigrateSource(
 *   id = "optime_url"
 * )
 */
class OptimeUrl extends Url {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {

    // Track last imported time.
    if (isset($configuration['track_last_imported']) && $configuration['track_last_imported']) {
      $migration->setTrackLastImported(TRUE);
    }

    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
  }

}
