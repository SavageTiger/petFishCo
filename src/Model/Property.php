<?php

namespace SvenH\PetFishCo\Model;

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
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }
}
