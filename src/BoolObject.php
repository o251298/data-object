<?php

namespace Codehigh\ArrayDataObject;

class BoolObject extends BaseDataObject implements DataObjectInterface
{
    public function __construct(private ?bool $value)
    {
    }

    public function get(): ?bool
    {
        return $this->value;
    }

    public function required(): bool
    {
        $this->assert($this->value);
        return $this->value;
    }

    public function default(bool $value): bool
    {
        return $this->isValid($this->value) ? $this->value : $value;
    }
}