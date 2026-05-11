# ReplaceGetFactoryCreateObjectWithHydrateObjectRule Tests

Тесты для Rector правила, которое заменяет вызовы `class::getFactory()->createObject()` на `class::hydrateObject()`.

## Структура

- `ReplaceGetFactoryCreateObjectWithHydrateObjectRuleTest.php` - основной тест класс
- `config/configured_rule.php` - конфигурация правила для тестов
- `Fixture/` - тестовые примеры кода в формате `.php.inc`

## Формат тестовых файлов

Каждый файл в `Fixture/` содержит два блока кода, разделенных `-----`:

```php
<?php
// Исходный код (до применения правила)
?>
-----
<?php
// Ожидаемый результат (после применения правила)
?>
```

## Тестовые кейсы

1. **static_class_call.php.inc** - статический вызов на имени класса
2. **variable_static_call.php.inc** - статический вызов на переменной
3. **nested_call.php.inc** - вложенный вызов внутри конструктора
4. **multiple_calls.php.inc** - несколько вызовов в одной функции
5. **skip_different_method.php.inc** - случаи, которые НЕ должны меняться

## Запуск тестов

```bash
vendor/bin/phpunit tests/Rector/ReplaceGetFactoryCreateObjectWithHydrateObjectRule/
```
