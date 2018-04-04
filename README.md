# csrf-token
## Class Anti Security CSRF TOKEN

This project is available on [Packagist](https://packagist.org/packages/hoangnamitc/csrf-token), and installation via Composer is the recommended way to install <b>csrf-token</b>. Just add this line to your composer.json file:

```
"hoangnamitc/csrf-token": "dev-master"
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
$token->set();      // Token create one times
$token->set('*');   // Token create many times
```

- Get value of Token:
```
$token->get();
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

- Detele All token
```
$token->deleteAll();
```


## Authors

**[hoangnamitc](https://github.com/hoangnamitc/csrf-token)**