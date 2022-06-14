<?php

namespace roaresearch\yii2\enum\models;

use roaresearch\yii2\enum\DescriptiveEnum;
use ValueError;

/**
 * Defines a map to be used for static terminologies on the
 * class. The structure is `['attribute_name' => EnumName::class]`
 *
 * The `EnumName` must be a enum implementing the
 * `roaresearch\yii2\enum\DescriptiveEnum` interface.
 *
 * Usage
 *
 * ```php
 * use yii\base\Model;
 * use roaresearch\yii2\enum\models\EnumMapTrait;
 * use common\enums\Payment;
 *
 * class Order extends Model {
 *     use EnumTrait;
 *
 *     public string $payment;
 *
 *     public static function enums()
 *     {
 *         return [
 *             'payment' => Payment::class,
 *         ];
 *     }
 *
 *     public function getPaymentStatus()
 *     {
 *         return ;
 *     }
 * }
 * ```
 */
trait EnumMapTrait
{
    /**
     * @var array cache for maps of enums.
     */
    protected static array $enumMaps = [];

    /**
     * @return array map of attribute => enum_class
     */
    protected abstract static function enums(): array;

    public static function assureEnumClass(string $name): string
    {
        static::$enumMaps[static::class] ??= static::enums();

        return static::$enumMaps[static::class][$name]
            ?? throw new ValueError(
                "Undefined map for enum `$name` in " . static::class
            );
    }

    public function exertEnum(string $attribute): ?DescriptiveEnum
    {
        return static::assureEnumClass($attribute)::exertFrom($this->$attribute);
    }

    public function tryEnum(string $attribute): ?DescriptiveEnum
    {
        return static::assureEnumClass($attribute)::tryFrom($this->$attribute);
    }
}
