<?php

namespace SvenH\PetFishCo\Model;

use Symfony\Component\Serializer\Annotation\Groups;

class Property implements PropertyInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $type;

    /**
     * Property constructor.
     *
     * @param string $value
     * @param int    $type
     *
     * @throws \Exception
     */
    public function __construct(string $value, int $type)
    {
        $this->value = $value;
        $this->type  = $type;
    }

    /**
     * {@inheritdoc}
     *
     * @Groups({"list", "detail"})
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
