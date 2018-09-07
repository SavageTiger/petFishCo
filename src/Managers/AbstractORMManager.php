<?php

namespace SvenH\PetFishCo\Managers;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractORMManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    protected $className = null;

    /**
     * Find fish by id
     *
     * @param string $id
     *
     * @return null|object
     */
    public function findOneById(string $id)
    {
        return $this->em->getRepository($this->className)->findOneById($id);
    }

    /**
     * Find fish by its name
     *
     * @param string $name
     *
     * @return null|object
     */
    public function findOneByName(string $name)
    {
        return $this->em->getRepository($this->className)->findOneBy([ 'name' => $name ]);
    }

    /**
     * Find all the fish
     *
     * @return array
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->className)->findAll();
    }
}