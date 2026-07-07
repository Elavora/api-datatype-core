<?php

declare(strict_types=1);

namespace Elavora\Api\DataTypes\Core\Tests;

use Elavora\Api\DataTypes\AbstractDataType;
use Elavora\Api\Framework\Contracts\Responseable;
use PHPUnit\Framework\TestCase;

final class ResponseableDataTypeTest extends TestCase
{
    public function testAbstractDataTypeCanBeReturnedAsResponseable(): void
    {
        self::assertInstanceOf(Responseable::class, ResponseableTestDataType::from(' ok '));
    }
}

final readonly class ResponseableTestDataType extends AbstractDataType
{
    public static function isValid(mixed $value): bool
    {
        return is_string($value) && trim($value) !== '';
    }
}
