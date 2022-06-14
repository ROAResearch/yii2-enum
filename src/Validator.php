<?php

namespace roaresearch\yii2\enum;

use yii\validators\{Validator as BaseValidator, ValidationAsset};
use Yii;

/**
 * Validates that the attribute value is among the index list in an enum
 *
 * ```php
 * use roaresearch\yii2\enum\Validator as EnumValidator;
 *
 * public function rules()
 * {
 *     return [
 *         [['payment'], EnumValidator::class],
 *     ];
 * }
 * ```
 */
class Validator extends BaseValidator
{
    /**
     * @var boolean whether the comparison is strict (both type and value must be the same)
     */
    public bool $strict = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->message ??= Yii::t('yii', '{attribute} is invalid.');
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        try {
            $model->exertEnum($attribute);
        } catch (ValueError $e) {
        }
    }
}
