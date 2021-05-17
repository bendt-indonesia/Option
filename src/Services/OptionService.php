<?php

namespace Bendt\Option\Services;

use Bendt\Option\Models\Option;
use Bendt\Option\Models\OptionDetail;

class OptionService
{
    public static $reserved_fixed = [
        'Contract Type' => [
            'New'       => 1,
            'Renewal'   => 2,
        ],
    ];

    public static $reserved_modifiable = [
        'Example 1' => [
            'Option Example' => [
                'value'=> '010',
                'code' => '010',
                'is_reserved' => true, // optional
                'is_modifiable' => false, // optional
            ],
        ],
        'Nama Panggilan' => [
            'Mr.',
            'Mrs.',
            'Madam',
            'Bpk.',
            'Ibu',
        ],
        'Example 3' => [
            'Kontrak',
            'Dokumen',
            'Gambar / Foto',
            'Faktur Pajak' => [
                'value' => 2,
                'code' => 2,
                'is_reserved' => true,
                'is_modifiable' => false,
            ],
        ],
    ];

    public static $option = [
        'Warna' => [
            'Hitam' => 'Hitam',
            'Merah' => 'Merah',
            'Hijau' => 'Hijau',
            'Emas' => 'Emas',
            'Kuning' => 'Kuning',
            'Ungu' => 'Ungu',
            'Silver' => 'Silver',
            'Biru Laut' => 'Biru Laut',
            'Biru Langit' => 'Biru Langit',
            'Cokelat' => 'Cokelat',
            'Abu - abu' => 'Abu - abu',
        ],
    ];

    /**
     * Run the database seeds.
     * @param array $reserved_fixed
     * @param array $reserved_modifiable
     * @param array $option
     *
     * @return void
     */
    public static function seed($reserved_fixed = [], $reserved_modifiable = [], $option = [])
    {
        self::$reserved_fixed = $reserved_fixed;
        self::$reserved_modifiable = $reserved_modifiable;
        self::$option = $option;
        self::option();
    }

    protected static function option() {
        self::seedOption(self::$reserved_fixed, 1, 0);
        self::seedOption(self::$reserved_modifiable, 1, 1);
        self::seedOption(self::$option, 0, 1);
    }

    protected static function seedOption($data, $is_reserved = 1, $is_modifiable = 1) {

        foreach ($data as $name => $details) {
            $slug = \Illuminate\Support\Str::slug($name);
            $option = new Option([
                'name' => $name,
                'slug' => $slug,
                'is_active' => 1,
                'is_reserved' => $is_reserved,
                'is_modifiable' => $is_modifiable,
            ]);
            $option->save();

            foreach ($details as $label => $value) {
                if(is_int($label)) {
                    $label = $value;
                }

                $array = [
                    'option_id' => $option->id,
                    'name' => $label,
                    'is_reserved' => $is_reserved,
                    'is_modifiable' => $is_modifiable,
                ];

                if(is_array($value)) {
                    $array = array_merge($array,$value);
                } else {
                    $array['value'] = $value;
                }

                $det = new OptionDetail($array);
                $det->process(null);
            }
        }
    }
}
