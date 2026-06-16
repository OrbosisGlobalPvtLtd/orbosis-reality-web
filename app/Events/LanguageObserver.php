<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LanguageObserver {
    use Dispatchable, SerializesModels;

    public $languageData;

    /**
     * Create a new event instance.
     *
     * @param array $languageData
     */
    public function __construct(array $languageData) {
        $this->languageData = $languageData;
    }
}
