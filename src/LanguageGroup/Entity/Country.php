<?php declare(strict_types=1);

namespace LanguageGroup\Entity;

/**
 * Class Country
 * @package LanguageGroup\Entity
 */
class Country
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
