<?php

namespace roaresearch\yii2\enum;

use Yii;
use yii\helpers\StringHelper;

trait DescriptiveEnumTrait
{
    public function getDesc(): string
    {
        return Yii::t($this->getTranslationCategory(), $this->name);
    }

    public static function exertFrom(
        int|string|null $value,
        array $emptyValues = [null, '']
    ): ?static {
        return in_array($value, $emptyValues, true)
            ? null
            : static::from($value);
    }

    public static function caseDescriptions(): array
    {
        return array_map(
            fn (DescriptiveEnum $enum) => $enum->getDesc(),
            static::cases()
        );
    }

    /**
     * @return string the category used by default to translate the name of the
     * enum cases.
     */
    public function getTranslationCategory(): string
    {
        return StringHelper::basename($this::class);
    }
}
