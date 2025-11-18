# Using the form elements extension

DotTwigrenderer extends Twig with a function based on `TwigTest` that checks if each `Form` element is an instance of its class.

```php
public function getTests(): array;
```

## Example usage

```twig
{% if false not in getTests() %}
    
    {# your code #}

{% endif %}
```
