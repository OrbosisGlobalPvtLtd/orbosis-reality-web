<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TranslateTableData implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $table;
    protected $fields;
    protected $langCode;
    protected $operation;

    /**
     * Create a new job instance.
     *
     * @param string $table
     * @param array $fields
     * @param string $langCode
     * @param string $operation
     */
    public function __construct(string $table, array $fields, string $langCode, string $operation) {
        $this->table = $table;
        $this->fields = $fields;
        $this->langCode = $langCode;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        switch ($this->operation) {
            case 'insert':
            case 'update':

                $rows = DB::table($this->table)->get();

                foreach ($rows as $row) {
                    foreach ($this->fields as $field) {
                        // Check if a translation already exists
                        $translationExists = DB::table('translations')
                            ->where('translatable_type', $this->table)
                            ->where('translatable_id', $row->id)
                            ->where('lang_code', $this->langCode)
                            ->where('key', $field)
                            ->exists();

                        if (!$translationExists && !empty($row->$field)) {
                            // Insert translation
                            DB::table('translations')->insert([
                                'translatable_type' => $this->table,
                                'translatable_id' => $row->id,
                                'lang_code' => $this->langCode,
                                'key' => $field,
                                'value' => gTranslate($row->$field, $this->langCode),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }

                break;

            case 'delete':
                DB::table('translations')
                    ->where('translatable_type', $this->table)
                    ->where('lang_code', $this->langCode)
                    ->delete();
                break;
        }
    }

}
