<?php

namespace SvenH\PetFishCo\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractORMManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

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

    /**
     * Update entity
     *
     * @param $entity
     */
    public function update($entity)
    {
        $invalid = $this->validator->validate($entity);

        if (count($invalid) > 0) {
            /** @var ConstraintViolation $violation */
            $violation = current($invalid);
            $violation = $violation[0];

            throw new \Exception($violation->getMessage());
        }

        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * Get the className of the primary subject handled by this manager
     *
     * @return string
     */
    public function getManagedClass(): string
    {
        return $this->className;
    }
}