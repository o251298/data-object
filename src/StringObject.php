<?php

namespace Codehigh\ArrayDataObject;

class StringObject extends BaseDataObject implements DataObjectInterface
{

    public function __construct(private ?string $value)
    {
    }

    public function get(): ?string
    {
        return $this->value;
    }

    public function required(): string
    {
        $this->assert($this->value);
        return $this->value;
    }

    public function default(string $value): string
    {
        return $this->isValid($this->value) ? $this->value : $value;
    }
}