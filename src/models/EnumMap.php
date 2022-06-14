<?php

namespace roaresearch\yii2\enum\models;

use roaresearch\yii2\enum\DescriptiveEnum;

interface EnumMap
{
    /**
     * Assure there is a declared enum for a certain name.
     *
     * @param string $name
     * @throws \ValueError when the name is not defined
     */
    public static function assureEnumClass(string $name): string;

    /**
     * Exert an attempt to get an enum case for an attribute and its value.
     *
     * @param string $attribute
     * @return ?DescriptiveEnum will return `null` when the attribute value is
     * empty
     * @throws \ValueError either the attribute has no associated enum or the
     * attribute value is not a valid enum case.
     */
    public function exertEnum(string $attribute): ?DescriptiveEnum;

    /**
     * Tries to get an enum case for an attribute and its value.
     *
     * @param string $attribute
     * @return ?DescriptiveEnum will return `null` when the attribute value is
     * empty
     */
    public function tryEnum(string $attribute): ?DescriptiveEnum;
}

