<?php

namespace Drupal\uh_space_site\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

/**
 * Provides a Hero Block.
 *
 * @Block(
 *   id = "hero_block",
 *   admin_label = @Translation("Hero Block"),
 *   category = @Translation("UH Space Site"),
 * )
 */
class HeroBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');

    $block = [
      '#theme' => 'hero_block',
      '#title' => $node->getTitle(),
      '#background_image' => FALSE,
    ];

    $lead = $node->field_lead_text->getValue();
    if (!empty($lead[0]['value'])) {
      $block['#lead'] = $lead[0]['value'];
    }

    $image = $node->field_featured_image->getValue();
    if (!empty($image[0]['target_id'])) {
      $file = File::load($image[0]['target_id']);
      $path = $file->getFileUri();
      $url = ImageStyle::load('hero_image_half')->buildUrl($file->getFileUri());
      $block['#background_image'] = $url;
    }

    return $block;
  }

}
