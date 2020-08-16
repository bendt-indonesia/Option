<?php

namespace App;

use App\Enums\GenderType;
use App\User;
use App\Models\Option;
use App\Models\Module;
use App\Models\CustomerOwnership;

class StoreMapper
{
    public static function MAP($key)
    {
        $options = [
            GenderType::KEY,
        ];

        if(in_array($key,$options)) {
            return function() use($key) {
                return Option::with('option_detail')->where('slug', $key)->first();
            };
        }

        switch ($key)
        {
            case 'module':
                return function() { return Module::all(); };
            case 'module_slug':
                return function() {
                    return Module::all()->keyBy('slug')->toArray();
                };
            case 'users':
                return function() { return User::all(); };
            case 'option':
                return function() { return Option::with('option_detail')->get(); };
            case 'survey-status':
                return function() { return Option::with('option_detail')->where('slug', 'survey-status')->first(); };
            default:
                return null;
        }
    }
}
