# Method #1: Factory

## Step 1: Create a factory that retrieves the SessionManger from the container

```php
class ExampleFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ExampleService(
            $container->get(TemplateRendererInterface::class)
        )
    }
}
```

## Step 2: Access through your Service

```php
class ExampleService
{
    private TemplateRendererInterface $template;
    
    public function __construct(TemplateRendererInterface $template) 
    {
        $this->template = $template;
    }
}
```

## Step 3: Register the factory

Open the ConfigProvider of the module where your repository resides.

Add a new entry under `factories`, where the key is your service's FQCN and the value is your factory's FQCN.

See the below example for a better understanding of the file structure.

```php
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
                ExampleService::class => ExampleFactory::class,
            ],
        ];
    }
}
```
