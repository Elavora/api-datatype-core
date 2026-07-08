<?php

declare(strict_types=1);

namespace Elavora\Api\DataTypes;

use Elavora\Api\Framework\Contracts\DataType;
use Elavora\Api\Framework\Contracts\Insertable;
use Elavora\Api\Framework\Contracts\Responseable;
use InvalidArgumentException;

abstract readonly class AbstractDataType implements DataType, Insertable, Responseable
{
    final protected function __construct(protected mixed $value)
    {
    }

    /**
     * Cria e valida uma instancia do DataType.
     */
    public static function from(mixed $value): static
    {
        if (!static::isValid($value)) {
            throw new InvalidArgumentException(sprintf('Valor invalido para %s.', static::class));
        }

        return new static(static::normalize($value));
    }

    /**
     * Retorna o valor normalizado.
     */
    public function value(): string|int|bool|float|null
    {
        return $this->value;
    }

    /**
     * Retorna o valor serializavel.
     */
    public function jsonSerialize(): string|int|bool|float|null
    {
        return $this->value();
    }

    /**
     * Retorna a representacao textual do valor.
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }

    protected static function normalize(mixed $value): mixed
    {
        return $value;
    }
}
