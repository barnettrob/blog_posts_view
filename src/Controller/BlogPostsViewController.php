<?php

namespace Drupal\blog_posts_view\Controller;

use Drupal\views\Routing\ViewPageController;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Class BlogPostsViewController
 * @package Drupal\blog_posts_view\Controller
 */
class BlogPostsViewController extends ViewPageController {
  /**
   * {@inheritdoc}
   */
  public function handle($view_id, $display_id, RouteMatchInterface $route_match) {
    // Drupal Defaults.
    $view_id = 'taxonomy_term';
    $display_id = 'page_1';

    // Entity of the requested term.
    $term = $route_match->getParameter('taxonomy_term');

    // Get the vid (vocabulary machine name) of the current term.
    $vid = $term->get('vid')->first()->getValue();
    $vid = $vid['target_id'];

    // If the vocabulary is 'blogs' use the 'latest_blogs' custom view.
    if ($vid == 'blogs') {
      // Change view.
      $view_id = 'latest_blogs';
      $display_id = 'page_blogs_taxonomy';
    }

    return parent::handle($view_id, $display_id, $route_match);
  }
}
