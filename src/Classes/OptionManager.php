<?php

namespace Bendt\Option\Classes;

use Bendt\Option\Models\Option;
use Bendt\Option\Services\OptionService;
use Illuminate\Support\Facades\DB;

class OptionManager
{
    public function cache($options, $key)
    {
        if (in_array($key, $options)) {
            return function () use ($key) {
                return Option::with('option_detail')->where('slug', $key)->first();
            };
        }
    }

    public function find($option_key, $value, $key = 'value')
    {
        try {
            $option = $this->get($option_key);
            if (!$option) abt('BENDT', 'Option ' . $option_key . ' not found!');
            $data = collect($option->option_detail)->firstWhere($key, $value)->toArray();

            return $data;
        } catch (\Throwable $e) {
            abt('Helper > foption', $e->getMessage());
        }
    }

    public function get($key)
    {
        $store = config('bendt-option.class.store');
        return $store::get($key);
    }

    public function options($slug, $map_value_idx = false)
    {
        $option = $this->get($slug);
        $option_details = collect($option->option_detail)->keyBy('value');

        if ($map_value_idx) {
            foreach ($option_details as $value => $model) {
                $option_details[$value] = $model[$map_value_idx];
            }
        }

        $option_details = $option_details->toArray();

        return $option_details;
    }

    public function seed($static, $reserved, $modifiable)
    {
        OptionService::seed($static, $reserved, $modifiable);
    }
}
