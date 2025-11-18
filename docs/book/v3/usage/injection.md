# Method #2: Injection

If you are using [dot-annotated-services](https://github.com/dotkernel/dot-annotated-services/) in your project, you don't need to create a separate factory, follow the below steps.

## Step 1: Access through your Service

```php

class ExampleService
{
    private TemplateRendererInterface $template;

    /**
     * @Dot\AnnotatedServices\Annotation\Inject({
     *     TemplateRendererInterface::class,
     * })
     */
    public function __construct(TemplateRendererInterface $template) 
    {
        $this->template = $template;
    }
    
     //your methods
}
```

## Step 2: Register your service

Open the ConfigProvider of the module where your repository resides.

Add a new entry under `factories`, where the key is your service's FQCN and the value is `Dot\AnnotatedServices\Factory\AbstractAnnotatedFactory`.

See below example for a better understanding of the file structure.

```php
<?php

declare(strict_types=1);

namespace YourApp;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                ExampleService::class => AbstractAnnotatedFactory::class,
            ],
        ];
    }
}
```
