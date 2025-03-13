<?php

declare(strict_types=1);

namespace App\Plates\Extension;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Plates\Template\Template;

class ColorExtension implements ExtensionInterface
{
    protected Engine $engine;

    public Template $template;

    private array $colors = [
        [
            'text-bg-main' => 'text-bg-secondary',
            'text-indicator' => 'text-secondary',
            'text-indicator-emphasis' => 'text-secondary-emphasis',
            'text-bg-indicator' => 'text-bg-secondary',
            'bg-indicator-subtle' => 'bg-secondary-subtle',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-danger',
            'text-indicator' => 'text-danger',
            'text-indicator-emphasis' => 'text-danger-emphasis',
            'text-bg-indicator' => 'text-bg-danger',
            'bg-indicator-subtle' => 'bg-danger-subtle',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-primary',
            'text-indicator' => 'text-primary',
            'text-indicator-emphasis' => 'text-primary-emphasis',
            'text-bg-indicator' => 'text-bg-primary',
            'bg-indicator-subtle' => 'bg-primary-subtle',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-success',
            'text-indicator' => 'text-success',
            'text-indicator-emphasis' => 'text-success-emphasis',
            'text-bg-indicator' => 'text-bg-success',
            'bg-indicator-subtle' => 'bg-success-subtle',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-warning',
            'text-indicator' => 'text-warning',
            'text-indicator-emphasis' => 'text-warning-emphasis',
            'text-bg-indicator' => 'text-bg-warning',
            'bg-indicator-subtle' => 'bg-warning-subtle',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-info',
            'text-indicator' => 'text-info',
            'text-indicator-emphasis' => 'text-info-emphasis',
            'text-bg-indicator' => 'text-bg-info',
            'bg-indicator-subtle' => 'bg-info-subtle',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-light',
            'text-indicator' => 'text-light-emphasis',
            'text-indicator-emphasis' => 'text-light-emphasis',
            'text-bg-indicator' => 'text-bg-light',
            'bg-indicator-subtle' => 'bg-light-subtle',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-dark',
            'text-indicator' => 'text-light',
            'text-indicator-emphasis' => 'text-light-emphasis',
            'text-bg-indicator' => 'text-bg-light',
            'bg-indicator-subtle' => 'bg-light-subtle',
            'link-main' => 'link-light',
        ],
    ];

    public function register(Engine $engine)
    {
        $this->engine = $engine;

        $engine->registerFunction('color', [$this, 'color']);
    }

    public function color(): array
    {
        $data  = $this->template->data();

        return $this->colors[$data['theme']];
    }
}
