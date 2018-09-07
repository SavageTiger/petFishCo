<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\PropertyValue as BasePropertyValue;

/**
 * @ORM\Entity
 * @ORM\Table(name="property_value")
 */
class PropertyValue extends BasePropertyValue
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
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
