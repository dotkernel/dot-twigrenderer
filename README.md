# dot-twigrenderer
Package with useful twig extensions and ZF3 view helpers made available for Twig

## Installation

Run the following command in your project directory
```bash
$ composer require dotkernel/dot-twigrenderer
```

Merge the `ConfigProvider` output to your application's autoloaded configuration, in order to register the required dependencies.


## ZF3 form helpers

All form helpers from [zendframework/zend-form](https://github.com/zendframework/zend-form/tree/master/src/View/Helper) are made available in twig.

You can call these helpers twig style using `{{ helperName(...) }}` in you templates.

##### Example
```
{{ formLabel(form.get('someFormElement')) }}

{{ formElement(form.get('someFormElement')) }}

{{ formCheckbox(form.get('checkbox')) }}

and so on
```

## AuthenticationExtension

Defines 2 TWIG functions to rapidly check the authenticated identity and get the identity object.
* `hasIdentity` - it can be used in templates to hide content based on authentication status
* `getIdentity` - gets the stored authenticated identity, so you can get its username, email and so on, depending on your implementation


## AuthorizationExtension

Defines one TWIG template function to check in templates if someone is granted some permission
* `isGranted(permission, roles = [], context)` 

## FlashMessengerExtension

Defines 2 function in TWIG for flash messages parsing.
* `flashMessagesRender(namespace = null)` - not implemented yet(Reserved for parsing a default standard flash messages block)
* `flashMessagesPartial(partial, namespace = null, extra = [])` - uses the template `partial` to parse the messages, passing any additional `extra` parameters into the partial template
In this case, you need to implement the parsing logic in the partial template. It offers great flexibility in rendering the messages in your custom way.

## NavigationExtension

Defines 3 TWIG function used to parse a navigation container from dot-navigation into your templates.
* `navigationMenu(container)` - renders the navigation container specified by the parameter in a default manner
* `navigationPartial(container, partial, extra)` - renders the navigation menu specified by container param using the template given. The parsing logic must be implemented into the partial, but it offers great flexibility
* `navigationPageAttributes(page)` - given a specific menu item(page) it will render its attributes into HTML attributes, ready to be added to the template. This is useful when parsing the menu through a partial.
