# Using the date extension

Dot-twigrenderer extends Twig with a function that calculates the difference between two dates.
The function converts dates to a time ago string like Facebook and Twitter has.
If `null` is passed as the second or third parameters, the current time will be used.

```php
public function diff(
    Environment $env,
    string|DateTimeInterface|null $date,
    string|DateTimeZone|null $now = null,
): string;
```

## Example usage

Pass Twig's Environment to the template

```php
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates/page');
$twigEnv = new \Twig\Environment($loader);

$this->template->render('page::templateName', [
    'env' => $twigEnv,
    #other parameters
]); 
```

This enables the use of the `diff` function:

```twig
{{ diff(env, '2024-02-20', '2024-02-18') }}
```
