# php-property-reader
A simple class implementation of a property reader introduced/suggested by Marco Pivetta (Ocramius) here: https://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/


## Example
```php
<?php

require 'PropertyReader.php';

use PropertyReader\PropertyReader;

class Greeter
{
    private $greeting = 'Hi there!';

    public function getGreeting()
    {
        return $this->greeting;
    }
}

$greeter = new Greeter;

echo $greeter->getGreeting(); // Hi there!

$greeting = & PropertyReader::read($greeter, 'greeting');
$greeting = 'Nice to meet you!';

echo $greeter->getGreeting(); // Nice to meet you!
```

### For php version < 7
```php
$geeting = & PropertyReader::newInstance()->read($greeter, 'greeting');
```

