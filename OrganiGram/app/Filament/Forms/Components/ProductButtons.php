<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class ProductButtons extends Field
{
    protected string $view = 'forms.components.product-buttons';

    public function categoryId($value)
    {
        $this->statePath('category_id');
        $this->extraAttributes(['category_id' => $value]);
        return $this;
    }

}
