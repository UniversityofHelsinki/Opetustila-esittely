<?php

namespace Drupal\migrate_optime_json\EventSubscriber;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\migrate\Event\MigrateEvents;
use Drupal\migrate\Event\MigrateImportEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Migrate Optime JSON event subscriber.
 */
class MigrateOptimeJsonSubscriber implements EventSubscriberInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The logger instance.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Constructs event subscriber.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, LoggerInterface $logger) {
    $this->entityTypeManager = $entity_type_manager;
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      MigrateEvents::POST_IMPORT => ['afterImport'],
    ];
  }

  /**
   * Function to process action after finishing a migration import operation.
   *
   * @param \Drupal\migrate\Event\MigrateImportEvent $event
   *   Event for migration import operation.
   */
  public function afterImport(MigrateImportEvent $event) {
    $migration = $event->getMigration();

    if (!empty($migration)) {
      // After import operation check Equipment taxonomy terms that are not
      // referenced any more.
      if ($migration->id() == 'optime_integration') {
        // Get Equipment taxonomy terms.
        /** @var \Drupal\taxonomy\TermInterface[] $terms */
        $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadTree('Equipment', 0, NULL, TRUE);
        foreach ($terms as $term) {
          // Check if term is referenced by any of spaces.
          $nodes = $this->entityTypeManager->getStorage('node')->loadByProperties(['field_equipment' => $term->id()]);
          // Delete term if not referenced by any of spaces.
          if (!$nodes) {
            $this->logger->info('Unused term of "%term_name" deleted from Equipment vocabulary.', ['%term_name' => $term->getName()]);
            $term->delete();
          }
        }
      }
    }
  }

}
