<?php

namespace roaresearch\yii2\enum;

/**
 * Interface used to create descriptive enums.
 */
interface DescriptiveEnum extends \BackedEnum
{
    /**
     * @return string the description for the case.
     */
    public function getDesc(): string;

    /**
     * Will fetch the enum for the value if its is provided and exists, will
     * throw an `\ValueError` exception if the value doesn't exists and will
     * return `null` if the provided value is empty.
     *
     * @param int|string|null $value
     * @param array $emptyValues allowed values which will return `null`
     * @return ?static
     * @throws \ValueError
     */
    public static function exertFrom(
        int|string|null $value,
        array $emptyValues = [null, '']
    ): ?static;

    /**
     * @return array map of case values and their description.
     */
    public static function caseDescriptions(): array;
}
