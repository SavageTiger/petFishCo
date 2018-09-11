<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Property as BaseProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="property")
 */
class Property extends BaseProperty
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\NotBlank(message="Please provide a name");
     */
    protected $value;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
