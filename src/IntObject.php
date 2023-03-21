<?php

namespace Codehigh\ArrayDto;

class IntObject extends BaseDataObject implements DataObjectInterface
{
    public function __construct(private ?int $value)
    {
    }

    public function get(): ?int
    {
        return $this->value;
    }

    public function required(): int
    {
        $this->assert($this->value);
        return $this->value;
    }

    public function default(int $value): int
    {
        return $this->isValid($this->value) ? $this->value : $value;
    }

}