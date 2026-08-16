# api-datatype-core

[![Packagist Version](https://img.shields.io/packagist/v/elavora/api-datatype-core.svg?style=flat-square)](https://packagist.org/packages/elavora/api-datatype-core)
[![PHP Version](https://img.shields.io/packagist/php-v/elavora/api-datatype-core.svg?style=flat-square)](https://packagist.org/packages/elavora/api-datatype-core)
[![Composer Quality](https://github.com/Elavora/api-datatype-core/actions/workflows/quality.yml/badge.svg?branch=main)](https://github.com/Elavora/api-datatype-core/actions/workflows/quality.yml)
[![CodeQL](https://github.com/Elavora/api-datatype-core/actions/workflows/codeql.yml/badge.svg?branch=main)](https://github.com/Elavora/api-datatype-core/actions/workflows/codeql.yml)
[![License](https://img.shields.io/packagist/l/elavora/api-datatype-core.svg?style=flat-square)](https://packagist.org/packages/elavora/api-datatype-core)

Base abstrata para criar DataTypes imutaveis com validacao, normalizacao e integracao aos contratos do framework Elavora.

## Requisitos

- PHP 8.3 ou superior.
- Demais requisitos declarados em [`composer.json`](composer.json).

## Instalacao

```bash
composer require elavora/api-datatype-core
```

## Inicio rapido

```php
use Elavora\Api\DataTypes\AbstractDataType;

final readonly class Codigo extends AbstractDataType
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

$valor = Codigo::from(' ABC ');
$normalizado = $valor->value();
```

`$normalizado` contem `ABC`. O resultado de `normalize()` deve ser `string`, `int`, `bool`, `float` ou `null`.

## Documentacao

Consulte o [guia de uso](docs/USO.md) para detalhes do contrato e validacao local.
