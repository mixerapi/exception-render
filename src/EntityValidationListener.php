<?php
declare(strict_types=1);

namespace MixerApi\ExceptionRender;

use ArrayObject;
use Cake\Event\EventManager;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ReflectionClass;
use ReflectionException;

class EntityValidationListener
{
    public function __construct()
    {
        EventManager::instance()->on(
            'Model.afterMarshal',
            function ($event, $entity,  $options) {
                $this->handler($event, $entity,  $options);
            }
        );
    }

    /**
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     */
    private function handler(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$entity->hasErrors()) {
            return;
        }

        try {
            $name = (new ReflectionClass($entity))->getShortName();
        } catch (ReflectionException $e) {
            $name = get_class($entity);
        }

        throw new ValidationException(
            sprintf('Error saving resource `%s`', $name),
            $entity
        );
    }
}