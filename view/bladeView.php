<?php
namespace kapcco\views;

use Jenssegers\Blade\Blade;

class BladeView {

    private $blade;

    public function __construct() {
        $this->blade = new Blade(__DIR__ . '/templates', __DIR__ . '/cache');
    }

    public function render($template, $data = []) {
        return $this->blade->make($template, $data)->render();
    }
}
