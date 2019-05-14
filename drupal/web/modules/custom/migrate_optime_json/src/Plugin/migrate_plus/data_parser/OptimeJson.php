<?php

/*
 * Idea & basic source for this JSON parser extension came from:
 *  http://agileadam.com/2017/09/extending-the-migrate-plus-json-parser-in-drupal-8/
 */

namespace Drupal\migrate_optime_json\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Json;

/**
 * Obtain JSON data for migration.
 *
 * @DataParser(
 *   id = "json_mymodule",
 *   title = @Translation("JSON Parser for My Module")
 * )
 */
class OptimeJson extends Json {

  /**
   * Retrieves the JSON data and returns it as an array.
   *
   * @param string $url
   *   URL of a JSON feed.
   *
   * @return array
   *   The selected data to be iterated.
   *
   * @throws \GuzzleHttp\Exception\RequestException
   */
  protected function getSourceData($url) {
    $response = $this->getDataFetcherPlugin()->getResponseContent($url);

    // Convert objects to associative arrays.
    $source_data = json_decode($response, TRUE);

    // If json_decode() has returned NULL, it might be that the data isn't
    // valid utf8 - see http://php.net/manual/en/function.json-decode.php#86997.
    if (is_null($source_data)) {
      $utf8response = utf8_encode($response);
      $source_data = json_decode($utf8response);
    }

    if ($this->itemSelector === 0) {
      // Don't bother with selectByDepth (it's expensive, and we already
      // have the top-level data as desired).
    }
    elseif (is_int($this->itemSelector)) {
      // Backwards-compatibility for depth selection.
      $source_data = $this->selectByDepth($source_data);
    }
    else {
      // Otherwise, we're using xpath-like selectors.
      $selectors = explode('/', trim($this->itemSelector, '/'));
      foreach ($selectors as $selector) {
        if (!empty($selector)) {
          $source_data = $source_data[$selector];
        }
      }
    }

    $modified_data = $this->prepareRows($source_data);

    return $modified_data;
  }

  /**
   * Modify any of the rows in the file.
   *
   * Any classes that implement OptimeJson can simply declare
   * a protected prepareRows function and massage the data as needed
   * before returning it.
   *
   * @param array $source_data
   *   Array of data.
   *
   * @return array
   *   Modified data.
   */
  protected function prepareRows(array $source_data) {
    // Do things with the $source_data!
    return $source_data;
  }

}
