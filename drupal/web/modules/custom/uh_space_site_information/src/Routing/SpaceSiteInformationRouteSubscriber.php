<?php

namespace Drupal\uh_space_site_information\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class SpaceSiteInformationRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Change form for the system.site_information_settings route
    // to Drupal\uh_space_site_information\Form\SpaceSiteInformationForm.
    if ($route = $collection->get('system.site_information_settings')) {
      $route->setDefault('_form', 'Drupal\uh_space_site_information\Form\SpaceSiteInformationForm');
    }
  }

}
