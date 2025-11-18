# Using the navigation extension

Dot-twigrenderer extends Twig with functions that use functionality from [dotkernel/dot-navigation](https://github.com/dotkernel/dot-navigation) to easily parse a menu and to display escaped HTML inside a template.

```php
public function htmlAttributes(Page $page): string;

public function renderMenu(NavigationContainer|string $container): string;

public function renderMenuPartial(
    NavigationContainer|string $container,
    string $partial,
    array $params = []
): string;
```

* `$partial` is the template file name
* `$params` is an optional array of items (key-value) passed to the template file
