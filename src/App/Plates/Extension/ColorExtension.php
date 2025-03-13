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
            'text-bg-main' => 'text-bg-primary',
            'text-indicator' => 'text-primary',
            'text-indicator-emphasis' => 'text-primary-emphasis',
            'text-bg-today' => 'text-bg-primary',
            'bg-indicator-subtle' => 'bg-primary-subtle',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-secondary',
            'text-indicator' => 'text-secondary',
            'text-indicator-emphasis' => 'text-secondary-emphasis',
            'bg-indicator-subtle' => 'bg-secondary-subtle',
            'text-bg-today' => 'text-bg-secondary',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-success',
            'text-indicator' => 'text-success',
            'text-indicator-emphasis' => 'text-success-emphasis',
            'bg-indicator-subtle' => 'bg-success-subtle',
            'text-bg-today' => 'text-bg-success',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-danger',
            'text-indicator' => 'text-danger',
            'text-indicator-emphasis' => 'text-danger-emphasis',
            'bg-indicator-subtle' => 'bg-danger-subtle',
            'text-bg-today' => 'text-bg-danger',
            'link-main' => 'link-light',
        ],
        [
            'text-bg-main' => 'text-bg-warning',
            'text-indicator' => 'text-warning',
            'text-indicator-emphasis' => 'text-warning-emphasis',
            'bg-indicator-subtle' => 'bg-warning-subtle',
            'text-bg-today' => 'text-bg-warning',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-info',
            'text-indicator' => 'text-info',
            'text-indicator-emphasis' => 'text-info-emphasis',
            'bg-indicator-subtle' => 'bg-info-subtle',
            'text-bg-today' => 'text-bg-info',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-light',
            'text-indicator' => 'text-light-emphasis',
            'text-indicator-emphasis' => 'text-light-emphasis',
            'bg-indicator-subtle' => 'bg-light-subtle',
            'text-bg-today' => 'text-bg-light border border-dark-subtle',
            'link-main' => 'link-dark',
        ],
        [
            'text-bg-main' => 'text-bg-dark',
            'text-indicator' => 'text-dark-emphasis',
            'text-indicator-emphasis' => 'text-dark-emphasis',
            'bg-indicator-subtle' => 'bg-dark-subtle',
            'text-bg-today' => 'text-bg-dark',
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

        return $this->colors[$data['color']];
    }
}
