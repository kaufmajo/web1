<?php

declare(strict_types=1);

namespace App\Form\Element\Select;

use App\Enum\TerminStatusEnum;
use Laminas\Form\Element;

class TerminStatusElementSelect extends Element\Select
{
    public function getValueOptionsFromConfig(): array
    {
        $return = [];

        foreach (TerminStatusEnum::cases() as $case) {
            $return[$case->value] = [
                'label' => $case->label(),
                'value' => $case->value,
            ];
        }

        return $return;
    }

    public function setValueOptionsFromConfig(): void
    {
        $this->setValueOptions($this->getValueOptionsFromConfig());
    }
}
