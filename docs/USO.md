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

## Validacao do pacote

Execute os comandos a partir da raiz do clone:

```bash
docker run --rm -v "${PWD}:/workspace" -w /workspace composer:2 composer update --no-interaction --no-progress --prefer-dist
docker run --rm -v "${PWD}:/workspace" -w /workspace composer:2 composer check
```
