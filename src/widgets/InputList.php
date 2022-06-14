<?php

namespace roaresearch\yii2\enum\widgets;

use Closure;
use yii\helpers\Html;

/**
 * Creates an HTML input list using an enum.
 */
abstract class InputList extends \yii\widgets\InputWidget
{
    /**
     * @var string the input type to be rendered using the HTML Helper.
     */
    protected readonly string $inputType;

    /**
     * @var string the active input type to be rendered using the HTML Helper.
     */
    protected readonly string $activeInputType;

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo $this->hasModel()
            ? $this->renderActiveInputList()
            : $this->renderInputList();
    }

    /**
     * @return string the rendered HTML for the enum input 
     */
    protected function renderActiveInputlist(): string
    {
        $closure = Closure::fromCallable([Html::class, $this->activeInputType]);

        return $closure(
            $this->model,
            $this->attribute,
            $this->model->assureEnumClass($this->attribute)::caseDescriptions(),
            $this->options
        );
    }

    /**
     * @return string the rendered HTML for the enum input 
     */
    protected function renderActiveInputlist(): string
    {
        $closure = Closure::fromCallable([Html::class, $this->inputType]);

        return $closure(
            $this->name,
            $this->value,
            $this->model->assureEnumClass($this->attribute)::caseDescriptions(),
            $this->options
        );
    }
}
