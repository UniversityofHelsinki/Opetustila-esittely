<?php

namespace Drupal\migrate_optime_json\Plugin\migrate\source;

use Drupal\migrate_plus\Plugin\migrate\source\Url;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\Core\Site\Settings;

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
    // Replace all placeholders from settings.
    if (isset($configuration['placeholders'])) {
      $this->handlePlaceholders($configuration, $migration->getSourceConfiguration());
    }
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
  }

  /**
  * Sets placeholders.
  *
  * @param array $configuration
  *   Plugin configuration.
  * @param array $source
  *   Migration source configuration.
  */
 private function handlePlaceholders(array &$configuration, array $source) {
   // Handling placeholders for url and api key.
   foreach ($configuration['placeholders'] as $placeholder) {
     $value = Settings::get($placeholder, '');
     foreach ($configuration['urls'] as $key => $url) {
       if ($placeholder == "optime-url") {
         $configuration['urls'][$key] = str_replace('{' . $placeholder . '}', $value, $url);
       }
     }
     foreach ($configuration['headers'] as $key => $header) {
       if ($placeholder == "optime-api-key") {
         $configuration['headers'][$key] = str_replace($placeholder, $value, $header);
       }
     }
   }
 }

}
