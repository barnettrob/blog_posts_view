<?php

namespace Drupal\blog_posts_view\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RoutingEvents;

class RouteSubscriber extends RouteSubscriberBase {
  public function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.taxonomy_term.canonical')) {
      $route->setDefault('_controller', '\Drupal\blog_posts_view\Controller\BlogPostsViewController::handle');
    }
  }

  /**
   * {@inheritdocs}
   */
  public static function getSubscribedEvents() {
    $events = parent::getSubscribedEvents();

    // Call after views.
    $events[RoutingEvents::ALTER] = array('onAlterRoutes', -180);

    return $events;
  }
}