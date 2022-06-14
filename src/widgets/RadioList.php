<?php

namespace roaresearch\yii2\enum\widgets;

/**
 * Creates an HTML radio input list using an enum.
 */
class RadioList extends InputList
{
    /**
     * @inheritdoc
     */
    protected readonly string $inputType = 'radioList';

    /**
     * @inheritdoc
     */
    protected readonly string $activeInputType = 'activeRadioList';
}
