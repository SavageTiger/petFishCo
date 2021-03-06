<?php

namespace SvenH\PetFishCo\Model;

/**
 * Picture
 */
class Picture implements PictureInterface
{
    /**
     * @var int
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
     * @param string $filename
     * @param string $binary
     */
    public function __construct(string $filename = 'unknown', string $binary = '')
    {
        $this->filename = $filename;
        $this->binary   = base64_encode($binary);
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
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * {@inheritdoc}
     */
    public function getBinary(bool $asBase64 = true): string
    {
        if (is_resource($this->binary) === true) {
            $this->binary = stream_get_contents($this->binary);
        }

        if ($asBase64 === false) {
            return base64_decode($this->binary);
        }

        return $this->binary;
    }
}
