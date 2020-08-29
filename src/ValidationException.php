<?php
declare(strict_types=1);

namespace MixerApi\ExceptionRender;

use Cake\Core\Exception\Exception;
use Cake\Datasource\EntityInterface;

class ValidationException extends Exception
{
    /**
     * @inheritDoc
     */
    protected $_defaultCode = 422;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * Constructor
     *
     * @param string|null $message a custom message, otherwise `Error saving resource` is used
     */
    public function __construct(?string $message = null, EntityInterface $entity)
    {
        $this->entity = $entity;

        parent::__construct($message ?? 'Error saving resource', null, null);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->entity->getErrors();
    }
}