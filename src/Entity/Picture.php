<?php

namespace SvenH\PetFishCo\Entity;

use Doctrine\ORM\Mapping as ORM;
use SvenH\PetFishCo\Model\Picture as BasePicture;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="picture")
 */
class Picture extends BasePicture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=64)
     *
     * @Serializer\Groups({"list", "detail"})
     */
    protected $filename;

    /**
     * @ORM\Column(type="binary", name="image_binary", nullable=false, length=16777215)
     *
     * @Serializer\Type("string")
     * @Serializer\Accessor("getBinary")
     * @Serializer\Groups({"list", "detail"})
     */
    protected $binary;
}
