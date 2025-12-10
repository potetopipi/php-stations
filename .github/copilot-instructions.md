# PHP Stations - Copilot Instructions

## Project Overview

**php-stations** is a PHP learning/training repository with 18 "stations" (exercises). Each station focuses on specific PHP concepts through progressive difficulty levels.

### Architecture

- **Stations**: Numbered directories (`Station01` through `Station18`) containing PHP exercises
- **Each Station Structure**:
  - `Question.php`: The main exercise with stub method(s) to implement
  - `Practice.php`: Example implementations or practice files (may have multiple files like `Practice1.php`, `Practice2.php`)
  - Supporting classes when needed (e.g., `Station12/Question/Product.php`)
- **Tests**: `tests/StationNN/QuestionTest.php` - PHPUnit tests validating `Question` class behavior
- **Namespace Convention**: `Src\StationNN` for source code, `Tests\StationNN` for tests

### Key Files
- `composer.json`: PSR-4 autoloading configured for `Src\` and `Tests\` namespaces
- `phpunit.xml`: Bootstrap configuration pointing to `vendor/autoload.php`
- `docker-compose.yml`: Two services - `php-container` and `composer_installation`
- `docker/php/Dockerfile`: PHP 8.1-FPM with composer and zip extension

## Development Workflow

### Setup & Execution
1. **Environment**: Docker required. Start with `docker compose up -d`
2. **Running Code**: Execute files inside container:
   ```bash
   docker compose exec php-container php src/StationNN/Question.php
   docker compose exec php-container php src/StationNN/Practice.php
   ```
3. **Running Tests**: 
   ```bash
   docker compose exec php-container ./vendor/bin/phpunit
   docker compose exec php-container ./vendor/bin/phpunit --group station01
   ```

### Code Patterns

#### Question Classes
- **Signature**: Methods with full type hints and return types (PHP 8.1+ style)
- **Typical Pattern**: Single `main()` method with various signatures
  - `public function main(): array` - Returns data for assertions
  - `public function main(mixed $arg): string` - Accepts arguments, returns result
  - `public function main(): string` - Generates output based on internal logic
- **Namespace**: Always `Src\StationNN`

#### Test Structure
- **File**: `tests/StationNN/QuestionTest.php`
- **Setup**: Instantiate Question class in `setUp()` method
- **Test Annotations**:
  - `@test` - Marks method as test
  - `@group stationNN` - Groups tests by station (lowercase with zero-padding)
  - `@dataProvider methodName` - For parameterized tests
- **Assertions**: Primarily `assertSame()` for type-strict comparison

#### Multi-File Stations (Station12+)
- Some stations use directory structure instead of single files
- `Station12/Question/Question.php` + supporting classes (`Product.php`, `Food.php`)
- Tests reference `Src\Station12\Question\Question` namespace
- Tests located in `tests/StationNN/Question/` subdirectories

## Critical Implementation Details

### Type System (PHP 8.1+)
- Strict type hints required: `int`, `string`, `float`, `bool`, `array`, `mixed`
- Return type declarations mandatory
- Use `gettype()` for type checking in early stations
- Type juggling behavior varies by context (e.g., `'1'` vs `1`)

### Common Patterns to Watch
1. **Type Coercion Tests**: Many exercises test PHP's type juggling behavior
2. **Array Operations**: Frequent use of array functions and iteration
3. **String Manipulation**: Type conversion between strings and numbers
4. **Object-Oriented Design**: Later stations introduce classes and inheritance

### Dependencies
- **Carbon**: Date/time library (nesbot/carbon ^2.64)
- **PHP Parser**: AST parsing (nikic/php-parser ^4.15)
- **PHPUnit**: Testing framework (^9)
- **PsySH**: Interactive PHP shell (for local development)
- **PHP CS Fixer**: Code style tool (for formatting)

## Testing & Validation

- **PHPUnit Bootstrap**: Always uses `vendor/autoload.php` via `phpunit.xml`
- **Test Groups**: Use `--group stationNN` to run single station tests
- **DataProviders**: Used for parameterized testing with multiple input/output combinations
- **Type Assertions**: Use `gettype()` or `instanceof` for validation, never loose comparisons

## Common Commands

```bash
# Run all tests
docker compose exec php-container ./vendor/bin/phpunit

# Run specific station tests
docker compose exec php-container ./vendor/bin/phpunit --group station03

# Execute practice file
docker compose exec php-container php src/Station03/Practice.php

# Execute question file (shows Question::main() output)
docker compose exec php-container php src/Station03/Question.php

# Access PHP shell
docker compose exec php-container psysh

# Check code style
docker compose exec php-container php-cs-fixer fix src/
```

## Notes for AI Agents

- When implementing `Question::main()`, ensure the method signature matches the test's expectations
- Return types and type hints are strict; always match the declared type signature
- Tests use `gettype()` comparisons, so type-coercion behavior matters
- For later stations (12+), check if Question is in a subdirectory structure
- Test annotations include station group tags in lowercase: `@group stationNN`
- Consider the "why" - these exercises teach specific PHP concepts (types, OOP, functions, etc.)
