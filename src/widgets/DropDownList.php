<?php

namespace roaresearch\yii2\enum\widgets;

/**
 * Creates an HTML dropDown input list using an enum.
 */
class DropDownList extends InputList
{
    /**
     * @inheritdoc
     */
    protected readonly string $inputType = 'dropDownList';

    /**
     * @inheritdoc
     */
    protected readonly string $activeInputType = 'activeDropDownList';
}
