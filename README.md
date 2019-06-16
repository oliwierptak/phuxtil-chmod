# phuxtil-chmod


Eeasy way to validate symbolic and octal modes used by unix `chmod` program.

> In Unix and Unix-like operating systems, chmod is the command and system call which is used to change the access permissions of file system objects. It is also used to change special mode flags.

### Installation

```
composer require phuxtil/chmod
```

### Usage

#### Facade

Create new instance:

```php
$facade = new ChmodFacade();
```


##### isReadable(...)

```php
$facade->isReadable('0755');     # true
$facade->isReadable('0334');     # true
$facade->isReadable('0333');     # false
```

##### isWritable(...)

```php
$facade->isWritable('0644');     # true
$facade->isWritable('0222');     # true
$facade->isWritable('0111');     # false
```

##### isExecutable(...)

```php
$facade->isExecutable('0755');     # true
$facade->isExecutable('0644');     # false
$facade->isExecutable('0222');     # false
```


##### validateByOctal(...)
```php
$facade->validateByOctal('0755', 'u', 'r');     # true
$facade->validateByOctal('0755', 'u', 'x');     # true
$facade->validateByOctal('0755', 'o', 'w');     # false
```

##### validateBySymbol(...)
```php
$facade->validateBySymbol('-rw-r--r--', 'u', 'r');     # true
$facade->validateBySymbol('-rw-r--r--', 'u', 'x');     # false
$facade->validateBySymbol('-rw-r--r--', 'o', 'r');     # true
```

##### applyUid(...)
```php
$facade->applyUid('0644');          # 4644
```

##### applyGid(...)
```php
$facade->applyGid('0644');          # 2644
```

##### applyUidAndGid(...)
```php
$facade->applyUidAndGid('0644');    # 6644
```

##### toArray()
```php
print_r($facade->toArray('0775'));
```

```php
[
    'u' => [
        'r' => 'r',
        'w' => 'w',
        'x' => 'x',
    ],
    'g' => [
        'r' => 'r',
        'w' => 'w',
        'x' => 'x',
    ],
    'o' => [
        'r' => 'r',
        'w' => '-',
        'x' => 'x',
    ]
]
```


See [`tests`](https://github.com/oliwierptak/phuxtil-chmod/blob/master/tests/Functional/Chmod/ChmodFacadeTest.php) for details.
