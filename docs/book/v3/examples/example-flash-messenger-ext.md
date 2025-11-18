# Using the flash messenger extension

Dot-twigrenderer extends Twig with functions that use functionality from [dotkernel/dot-flashMessenger](https://github.com/dotkernel/dot-flashMessenger) to list messages or partial messages.

```php
public function renderMessages(
    ?string $type = null,
    string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
): string; // empty response

public function function renderMessagesPartial(
    string $partial,
    array $params = [],
    ?string $type = null,
    string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
): string;
```

`renderMessagesPartial` returns messages previously passed to `dot-flashMessenger`.
The last three parameters can be omitted to list all messages sent to FlashMessenger.

* `$partial` is the template file name
* `$params` is an optional array of items (key-value) passed to the template file
* `$type` is an optional item that identifies a subkey of FlashMessenger's channel array
* `$channel` is an optional item that identifies FlashMessenger's channel

## Example usage

```twig
{{ renderMessagesPartial('page:partial') }}
```
