<?php 

namespace app\core\form;

use app\core\form\BaseField;
use app\core\Model;

class InputField extends BaseField {
    public const TYPE_TEXT = 'text';
    public const TYPE_PWD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;

    public function __construct(Model $model, string $attribute) {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField() {
        $this->type = self::TYPE_PWD;
        return $this;
    }

    public function renderInput(): string {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">', 
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '');
    }
}