# Guia de uso

`AbstractDataType` concentra a criacao validada de objetos de valor imutaveis.

## Criando um DataType

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

$codigo = Codigo::from(' ABC ');

echo $codigo->value(); // ABC
```

O construtor e protegido. Use sempre `from()`, que executa `isValid()` e `normalize()` antes de criar a instancia.

O valor normalizado deve ser `string`, `int`, `bool`, `float` ou `null`. Outros tipos geram `UnexpectedValueException`.

## Validação local

Como rodar os testes, o lint e o PHPStan, e como reproduzir o CI, está em
[Desenvolvimento e testes](DESENVOLVIMENTO.md). As restrições do `composer.json` (`php` `>=8.3` e
`elavora/api-framework` `^2.0`) e os scripts de qualidade estão em [Automação](AUTOMACAO.md#composerjson).

## Versão e compatibilidade

A versão `2.0` exige PHP `>=8.3` e `elavora/api-framework` `^2.0`. Para atualizar a partir da `1.0.0`, troque a
restrição do framework no `composer.json` do seu projeto:

```json
{
  "require": {
    "php": ">=8.3",
    "elavora/api-framework": "^2.0",
    "elavora/api-datatype-core": "^2.0"
  }
}
```

A API de `AbstractDataType` não muda (`from()`, `isValid()`, `normalize()`, `value()`, `jsonSerialize()` e
`__toString()`): só a dependência do framework sobe de major.
