# Using the translation extension

Dot-twigrenderer extends Twig with a filter called `trans` that parses translations in singular and plural forms.

The `local.php.dist` file in [frontend](https://github.com/dotkernel/frontend/blob/4.0/config/autoload/local.php.dist) provides an example for working with multiple languages. The `translator` variable can be expanded to other languages using [Poedit](https://poedit.net/) which can edit `.po` files like the example in `data/language/da_DK/LC_MESSAGES/messages.po`. The compiled file will have the extension `.mo`

To apply the translations

- the Twig templates need either `{% trans 'translateText' %}` or `{{ translateText|trans }}`
- then the js file needs `translateText("translateText")`

**NOTE:**
In order to have a proper behaviour of language selector, you need the language pack installed at the Operating System level.

`dnf install glibc-all-langpacks`

Then restart PHP-FPM.
