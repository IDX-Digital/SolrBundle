<?php

namespace FS\SolrBundle\Doctrine\Hydration;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DoctrineHydratorFactory
{
    /**
     * @var DoctrineValueHydrator
     */
    private $hydrator;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(\FS\SolrBundle\Doctrine\Hydration\DoctrineValueHydrator $hydrator, ObjectManager $objectManager)
    {
        $this->hydrator = $hydrator;
        $this->objectManager = $objectManager;
    }

    /**
     * @return DoctrineHydrator
     */
    public function factory()
    {
        $valueHydrator = $this->hydrator;

        $hydrator = new DoctrineHydrator($valueHydrator);
        if ($this->objectManager) {
            $hydrator->setOrmManager($this->objectManager);
        }

        return $hydrator;
    }
}