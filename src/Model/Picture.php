<?php

namespace SvenH\PetFishCo\Model;

/**
 * Picture
 */
class Picture implements PictureInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $binary;

    /**
     * @param string $fileName
     * @param string $binary
     */
    public function __construct(string $filename, string $binary)
    {
        $this->filename = $filename;
        $this->binary   = $binary;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * {@inheritdoc}
     */
    public function getBinary(): string
    {
        return $this->binary;
    }
}
