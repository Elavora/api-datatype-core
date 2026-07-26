<?php

declare(strict_types=1);

namespace Elavora\Api\DataTypes\Core\Tests;

use Elavora\Api\DataTypes\AbstractDataType;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

final class NormalizedValueTest extends TestCase
{
    #[DataProvider('primitiveValues')]
    public function testAcceptsPrimitiveNormalizedValues(
        string|int|bool|float|null $normalized
    ): void {
        $value = PrimitiveNormalizedDataType::from($normalized);

        self::assertSame($normalized, $value->value());
        self::assertSame($normalized, $value->jsonSerialize());
    }

    /**
     * @return iterable<string, array{string|int|bool|float|null}>
     */
    public static function primitiveValues(): iterable
    {
        yield 'string' => ['value'];
        yield 'int' => [42];
        yield 'bool' => [true];
        yield 'float' => [4.2];
        yield 'null' => [null];
    }

    #[DataProvider('unsupportedValues')]
    public function testRejectsUnsupportedNormalizedValues(
        mixed $normalized,
        string $expectedType
    ): void {
        try {
            UnsupportedNormalizedDataType::from($normalized);
            self::fail('Era esperada uma UnexpectedValueException.');
        } catch (UnexpectedValueException $exception) {
            self::assertStringContainsString(UnsupportedNormalizedDataType::class, $exception->getMessage());
            self::assertStringContainsString($expectedType, $exception->getMessage());
            self::assertStringNotContainsString('segredo', $exception->getMessage());
        }
    }

    /**
     * @return iterable<string, array{mixed, string}>
     */
    public static function unsupportedValues(): iterable
    {
        yield 'array' => [['segredo'], 'array'];
        yield 'object' => [(object) ['value' => 'segredo'], 'stdClass'];
    }

    public function testPreservesInvalidArgumentExceptionForRejectedInput(): void
    {
        $this->expectException(InvalidArgumentException::class);

        RejectedDataType::from('invalid');
    }
}

final readonly class PrimitiveNormalizedDataType extends AbstractDataType
{
    public static function isValid(mixed $value): bool
    {
        return true;
    }
}

final readonly class UnsupportedNormalizedDataType extends AbstractDataType
{
    public static function isValid(mixed $value): bool
    {
        return true;
    }
}

final readonly class RejectedDataType extends AbstractDataType
{
    public static function isValid(mixed $value): bool
    {
        return false;
    }
}
