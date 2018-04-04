# csrf-token
Class support create,delete,change... CSRF TOKEN

### Installing

Clone class from this github.

```
require 'token.class.php';
```

### Usage

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