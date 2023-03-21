<?php

namespace Codehigh\ArrayDto;

abstract class BaseDataObject
{
    private string $name = '';
    /**
     * @var callable[]
     */
    protected array $validations = [];

    /**
     * @return string
     */
    protected function getName(): string
    {
        return $this->name;
    }



    protected function setName(string $name): BaseDataObject
    {
        $this->name = $name;
    }

    protected function assert(mixed $value): void
    {
        if (!$this->isValid($value)) {
            throw new \Exception($this->getName() . " is bad");
        }
    }

    protected function isValid(mixed $value): bool
    {
        if ($value === null) return false;
        foreach ($this->validations as $validation) {
            if (!$validation()) return false;
        }
        return true;
    }
}