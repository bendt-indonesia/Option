<?php

/**
 * Option Helper
 *
 * @param string $key
 *
 * @return \App\Store
 */
if (!function_exists('option')) {
    function option($key)
    {
        return \App\Store::get($key);
    }
}


/**
 * List Options Key By Value
 * [
 *      value => option_detail model
 * ]
 * @param string $slug
 *
 * @return array
 */
if (!function_exists('options')) {
    function options($slug, $map_value_idx = false)
    {
        $option = option($slug);
        $option_details = collect($option->option_detail)
            ->keyBy('value');

        if ($map_value_idx) {
            foreach ($option_details as $value => $model) {
                $option_details[$value] = $model[$map_value_idx];
            }
        }

        $option_details = $option_details->toArray();

        return $option_details;
    }
}

/**
 * ADS List Option Detail
 *
 * @param string $slug
 *
 * @return array
 */
if (!function_exists('option_detail')) {
    function option_detail($slug, $pluck = null)
    {
        if ($pluck === null) $pluck = 'id';

        $option = option($slug);
        $data = collect($option->option_detail)->pluck($pluck)->toArray();

        return $data;
    }
}

/**
 * ADS Find Option Helper
 *
 * @param string $key
 * @param string $value
 *
 * @return array
 */
if (!function_exists('foption')) {
    function foption($slug, $value, $key = 'value')
    {
        try {
            $option = option($slug);
            if (!$option) abt('BENDT', 'Option ' . $slug . ' not found!');
            $data = collect($option->option_detail)->firstWhere($key, $value)->toArray();

            return $data;
        } catch (\Exception $e) {
            abt('Helper > foption',$e->getMessage());
        }
    }
}

/**
 * Throw Error String Generator
 *
 * @param string $code
 * @param string $message
 * @param int $http_code
 *
 * @return Array
 */
if (!function_exists('abt')) {
    function abt($error_code, $message, $http_code = 400)
    {
        //$errorMsg = "[ ERR: ".$error_code." ] ".$message;
        $errorMsg = $message . ' ( ' . $error_code . ' )';
        throw new \Exception($errorMsg, $http_code);
    }
}