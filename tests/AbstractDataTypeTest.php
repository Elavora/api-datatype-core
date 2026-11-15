<?php

declare(strict_types=1);

namespace Elavora\Api\DataTypes\Core\Tests;

use Elavora\Api\DataTypes\AbstractDataType;
use Elavora\Api\Framework\Contracts\DataType;
use Elavora\Api\Framework\Contracts\Insertable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class AbstractDataTypeTest extends TestCase
{
    public function testCreatesValidDataType(): void
    {
        $value = new CoreTestDataType(' ok ');

        self::assertInstanceOf(DataType::class, $value);
        self::assertInstanceOf(Insertable::class, $value);
        self::assertSame('ok', $value->value());
        self::assertSame('ok', (string) $value);
        self::assertSame('ok', $value->jsonSerialize());
    }

    public function testThrowsForInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CoreTestDataType('');
    }
}

final readonly class CoreTestDataType extends AbstractDataType
{
    public static function isValid(mixed $value): bool
    {
        return is_string($value) && trim($value) !== '';
    }

    protected static function normalize(mixed $value): string
    {
        return trim((string) $value);
    }
}
