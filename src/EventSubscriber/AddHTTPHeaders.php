<?php

/**
 * @file
 * Contains \Drupal\http_response_headers\EventSubscriber\AddHTTPHeaders.
 */

namespace Drupal\http_response_headers\EventSubscriber;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Provides AddHTTPHeaders.
 */
class AddHTTPHeaders implements EventSubscriberInterface {

  /**
   * The config object for the google_tag settings.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * Constructs a new Google Tag response subscriber.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory service.
   */
  public function __construct(ConfigFactoryInterface $configFactory) {
    $this->config = $configFactory->get('http_response_headers.settings');
  }

  /**
   * Sets extra HTTP headers.
   */
  public function onRespond(FilterResponseEvent $event) {
    if (!$event->isMasterRequest()) {
      return;
    }
    $response = $event->getResponse();

    $headers = $this->config->get('headers');
    var_dump($headers); exit;
    foreach ($headers as $key => $header) {
      if (!empty($header['name']) && $header['value']) {
        // @TODO Add context rules to header groups to allow
        // certain groups to only be applied in certain contexts.

        $response->headers->set($header['name'], $header['value']);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onRespond'];
    return $events;
  }

}
