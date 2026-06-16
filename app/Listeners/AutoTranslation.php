<?php

namespace App\Listeners;

use App\Events\LanguageObserver;
use App\Jobs\TranslateTableData;

class AutoTranslation
{
    /**
     * Handle the event.
     */
    public function handle(LanguageObserver $event): void
    {
        $langCode = $event->languageData['lang_code'] ?? '';
        $operation = $event->languageData['operation'] ?? 'insert';
        
        // List of translatable tables and their fields
        $tables = include(lang_path('tablesTranslation.php'));

        foreach ($tables as $table => $fields) {
            if ($langCode === 'en') {
                continue;
            }
            TranslateTableData::dispatch($table, $fields, $langCode, $operation);
        }

        /* foreach ($tables as $table => $fields) {
            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                foreach ($fields as $field) {
                    // Check if a translation already exists
                    $translationExists = DB::table('translations')
                    ->where('translatable_type', $table)
                        ->where('translatable_id', $row->id)
                        ->where('lang_code', $langCode)
                        ->where('key', $field)
                        ->exists();

                    if (!$translationExists && !empty($row->$field)) {
                        // Insert translation
                        DB::table('translations')->insert([
                            'translatable_type' => $table,
                            'translatable_id' => $row->id,
                            'lang_code' => $langCode,
                            'key' => $field,
                            'value' => gTranslate($row->$field, $langCode),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        } */


    }
}
