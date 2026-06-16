<?php

namespace App\Traits;

use App\Models\Translation;

trait TraitsForTranslation {
    public function translations() {
        return $this->morphMany(Translation::class, 'translatable', 'translatable_type', 'translatable_id');
    }

    public function translate($lang, $key) {
        $translation = $this->translations()
            ->where('lang_code', $lang)
            ->where('key', $key)
            ->value('value');

        if ($translation === null) {
            if (array_key_exists($key, $this->attributes)) {
                return $this->attributes[$key];
            }

            return null; // Optional: Handle missing property case
        }

        return $translation;
    }

    public function updateOrCreateTranslation($lang, $key, $value) {
        $this->translations()->updateOrCreate(
            [
                'lang_code' => $lang,
                'key' => $key,
            ],
            [
                'value' => $value,
            ]
        );
    }

    public function deleteAllTranslations() {
        return $this->translations()->delete();
    }

    public function deleteTranslation($lang, $key) {
        return $this->translations()
            ->where('lang_code', $lang)
            ->where('key', $key)
            ->delete();
    }

    /**
     * Override the __get method to dynamically handle translatable attributes.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key) {
        // Dynamically fetch translatable fields for the table
        $translatable = include(lang_path('tablesTranslation.php'));
        $translatableFields = $translatable[$this->getTable()] ?? [];

        if (in_array($key, $translatableFields)) {
            $lang_code = request()->is('admin*') ? admin_lang() : front_lang();

            if (empty($lang_code)) {
                $lang_code = config('app.locale'); // Fallback to default locale
            }

            return $this->translate($lang_code, $key);
        }

        // Default behavior for non-translatable attributes
        return parent::__get($key);
    }



    public function toArray()
    {
        $array = parent::toArray();

        $translatable = include(lang_path('tablesTranslation.php'));
        $translatableFields = $translatable[$this->getTable()] ?? [];

        $lang_code = request()->is('admin*') ? admin_lang() : front_lang();

        foreach ($translatableFields as $field) {
            $array[$field] = $this->translate($lang_code, $field);
        }

        return $array;
    }

}
