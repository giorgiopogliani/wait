# simple cli spinner
Simple cli spinner for PHP.

## Usage
As function
```php
wait('Wait...', function(){ 
    sleep(3); // slow code
});
```
Or as object
```php
$spinner = Spinner::create();

$spinner->update('Wait..');

$spinner->start();

sleep(3); // slow code

$spinner->stop();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
