<?php

namespace Codehigh\ArrayDto;

class ArrayObject extends BaseDataObject implements DataObjectInterface
{

    /**
     * @param array[] $value
     */
    public function __construct(private ?array $value)
    {
    }

    private function factoryDataObject(string $method, int|string $key): DataObjectInterface
    {
        return match ($method) {
            'array' => new ArrayObject(array_key_exists($key, $this->value) ? $this->value[$key] : null),
            'int' => new IntObject(array_key_exists($key, $this->value) ? $this->value[$key] : null),
            'string' => new StringObject(array_key_exists($key, $this->value) ? $this->value[$key] : null),
            'bool' => new BoolObject(array_key_exists($key, $this->value) ? $this->value[$key] : null),
        };
    }

    public function array(int|string $key): ArrayObject
    {
        $dto = $this->factoryDataObject(__FUNCTION__, $key);
        assert($dto instanceof ArrayObject);
        return $dto;
    }

    public function int(int|string $key): IntObject
    {
        $dto = $this->factoryDataObject(__FUNCTION__, $key);
        assert($dto instanceof IntObject);
        return $dto;
    }

    public function string(int|string $key): StringObject
    {
        $dto = $this->factoryDataObject(__FUNCTION__, $key);
        assert($dto instanceof StringObject);
        return $dto;
    }

    public function bool(int|string $key): BoolObject
    {
        $dto = $this->factoryDataObject(__FUNCTION__, $key);
        assert($dto instanceof BoolObject);
        return $dto;
    }

    /**
     * @return array[]|null
     */
    public function get(): ?array
    {
        return $this->value;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->value);
    }

    /**
     * @return array[]|null
     */
    public function decodeJSON(string|int $key): ?array
    {
        if ($this->has($key)) {
            return json_decode($this->value[$key]);
        }
        return null;
    }

    public function encodeJSON(string|int $key): ?string
    {
        if ($this->has($key)) {
            return json_encode($this->value[$key]);
        }
        return null;
    }
}