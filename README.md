# Nova Admin Panel for `lupka/laravel-api-logger` package

## Installation

You can install the package via Composer:

```bash
composer require lupka/nova-laravel-api-logger
```

The package will automatically register its service provider.

If you haven't done the setup for the `lupka/laravel-api-logger` package, you'll need to do that first. Then, add the following to your `NovaServiceProvider.php`:

```php
use Lupka\NovaLaravelApiLogger\NovaLaravelApiLogger;

...

public function tools()
{
    return [
        ...
        new NovaLaravelApiLogger,
    ];
}
```

If you want to restrict who can see the logs (a common use case for me has been restricting this to admins/developers), use the `canSee` method when adding the tool to restrict by email address (or any other criteria you have set up).

```php
(new NovaLaravelApiLogger)->canSee(function ($request) {
    return in_array($request->user()->email, ['alex@alexchalupka.com']);
}),
```
