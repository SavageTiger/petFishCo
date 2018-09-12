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

    /**
     * @var string|null
     */
    protected $className = null;

    /**
     * Find entity by id
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
     * Find entity by its name
     *
     * @param string $name
     *
     * @return null|object
     */
    public function findOneByName(string $name)
    {
        return $this->findOneByCriteria([ 'name' => $name ]);
    }

    /**
     * Find entity by user defined criteria
     *
     * @param array $criteria
     *
     * @return null|object
     */
    public function findOneByCriteria(array $criteria)
    {
        return $this->em->getRepository($this->className)->findOneBy($criteria);
    }

    /**
     * Find all the entities
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
     * @throws \Exception
     */
    public function update($entity)
    {
        $this->validate($entity);

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

    /**
     * Validate entity, throw exception when invalid
     *
     * @param mixed $entity
     *
     * @throws \Exception
     */
    protected function validate($entity)
    {
        $invalid = $this->validator->validate($entity);

        if (count($invalid) > 0) {
            /** @var ConstraintViolation $violation */
            $violation = current($invalid);
            $violation = $violation[0];

            throw new \Exception($violation->getMessage());
        }
    }
}