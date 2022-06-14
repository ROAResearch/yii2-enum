ROAResearch Yii2 Enum
==================

[![Latest Stable Version](https://poser.pugx.org/ROAResearch/yii2-enum/v/stable)](https://packagist.org/packages/ROAResearch/yii2-enum) [![Total Downloads](https://poser.pugx.org/ROAResearch/yii2-enum/downloads)](https://packagist.org/packages/ROAResearch/yii2-enum) [![Latest Unstable Version](https://poser.pugx.org/ROAResearch/yii2-enum/v/unstable)](https://packagist.org/packages/ROAResearch/yii2-enum) [![License](https://poser.pugx.org/ROAResearch/yii2-enum/license)](https://packagist.org/packages/ROAResearch/yii2-enum)

ROAResearch Yii2 Enum extension provides support for the ussage of enumarions in Yii2 models and forms.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/ROAResearch/yii2-enum/blob/master/composer.json) for this extension's requirements and dependencies.

To install, either run

```
$ php composer.phar require roaresearch/yii2-enum "*"
```

or add

```
"roaresearch/yii2-enum": "*"
```

to the `require` section of your `composer.json` file.

## Usage

### Create Enums

This library uses the enum feature added in php8.1, to use them you need to
implement the `roaresearch\yii2\enum\DescriptiveEnum` interface

```php
use roaresearch\yii2\enum\{DescriptiveEnum, DescriptiveEnumTrait}

enum UserStatus: int implements DescriptiveEnum
{
    use DescriptiveEnumTrait;

    case Pending = 1;
    case Active = 2;
    case Banned = 3;
}
```

By default the `DescriptiveEnumTrait` defines all the required methods including
automatically trying to translate the case names for the enum to make them human
readable. For example in the case above

```php
UserStatus::Pending->getDesc();

// is a shorcut for

Yii::t('UserStatus', 'Pending');
```

### Declare Enum for a Model Property

To use the full power of this library its necessary to create models that
implement the `roaresearch\yii2\enum\models\EnumMap` interface.

```php

use roaresearch\yii2\enum\{DescriptiveEnum, models\EnumMap, models\EnumMapTrait};
use common\enums\UserStatus;

class User extends ActiveRecord implements EnumMap
{
    use EnumMapTrait;

    public static function enums(): array
    {
        return [
            `status` => UserStatus::class,
        ];
    }

    /**
     * @return string human readable and translated description of the status
     */
    public function getStatusDesc(): ?string
    {
        return $this->tryEnum('status')?->getDesc();
    }
}
```

The method `getStatusDesc()` is optional, its useful to easily access the human
readable description of the status.

This way other tools like the validators and widgets can easily interact with
the model.

### Validator

You can validate an attribute value can be extracted from an enum using the
provided validator

```php
use roaresearch\yii2\enum\Validator as EnumValidator;

public function rules()
{
    return [
        ['status', EnumValidator::class],
    ];
}
```

More informations for [enums]
-----------------------------

Upgrade from [Farystha] library
-----------------------------

- Models must implement the `EnumMap` interface.
- Models have no longer the method `getAttributeDesc()`, lost in favor of using
  `null` safe operator
- Models `enums()` method no longer defines the enums themselves but a map for
  the enum classes. Method signature changed too.
- Validator `$skipOnEmpty` is set to `true`.
- Validator will throw exception if the provided model is not an `EnumMap` or
  has no mapped enum for the validated attributes.

## License

**ROAResearch Yii2 Enum** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.

[enums]: https://php.watch/versions/8.1/enums
[Farystha]: https://github.com/Faryshta/yii2-enum
