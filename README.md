# csrf-token
## Class Anti Security CSRF TOKEN

This project is available on [Packagist](https://packagist.org/packages/hoangnamitc/csrf-token), and installation via Composer is the recommended way to install <b>csrf-token</b>. Just add this line to your composer.json file:

```
"hoangnamitc/csrf-token": "~2.0"
```

or run

```
composer require hoangnamitc/csrf-token
```

## Installing

```
require 'token.class.php';
```

or via composer

```
require 'vendor/autoload.php';
```

## Usage

- Initial
```
$token = new \hoangnamitc\Token('token_name');
```

- Choose times create token after refresh
```
$token->set();        // Token create one times
$token->set('*', 10); // Token create with time lives is 10 second
$token->set('*');     // Token create many times, created continuity.
```

- Get name Token
```
$token->getName();
```

- Get value of Token:
```
$token->getToken();
```

- Validate Token
```
if ( $token->validate($token_value) ) {
    // Valid
} else {
    // invalid
}
```

- Detele token curently
```
$token->delete();
```

- Debug code
```
$token->debug();
```

~~$token->deleteAll()~~



## Authors

**[hoangnamitc](https://github.com/hoangnamitc/csrf-token)**