<?php

namespace Bendt\Option\Controllers\API\Traits;

use Bendt\Option\Models\Option;
use Bendt\Option\Models\OptionDetail as Model;
use Illuminate\Support\Facades\Cache;

trait OptionDetailTrait
{

    /**
     * Clear cache after store new option detail
     *
     * @param Model $model
     * @throws \Throwable
     * @return Boolean
     */
    public function clearCache($model)
    {
        Cache::forget($model->option->slug);

        return true;
    }

    /**
     * Clear cache option detail (bulk) after option changes
     *
     * @param array $optionIds
     * @throws \Throwable
     * @return Boolean
     */
    public function clearCacheBulk($optionIds)
    {
        $options = Option::whereIn('id', $optionIds)->get();
        foreach ($options as $option) {
            Cache::forget($option->slug);
        }

        return true;
    }

    /**
     * Check is option modifiable or not
     *
     * @param Model $model
     * @throws \Throwable
     * @return Boolean
     */
    public function checkModifiable($model)
    {
        if ($model->is_modifiable === 0) {
            abt('62201', 'This option is reserved by system and may not be modify.');
        }

        return true;
    }

    /**
     * Check is option modifiable (bulk) or not
     *
     * @param Object $models
     * @throws \Throwable
     * @return array
     */
    public function checkModifiableBulk($models)
    {
        $optionIds = [];
        foreach ($models as $model) {
            $optionIds[] = $model->option->id;
            $this->checkModifiable($model);
        }

        return $optionIds;
    }

    public function checkDuplicatedName($code, $input, $id = null)
    {
        $check = Model::where('option_id', $input['option_id'])
            ->where('name', 'like', $input['name']);

        if($id) $check = $check->where('id','!=',$id);
        $check = $check->first();

        if ($check) abt($code, 'Duplicated option name!');
    }

    public function checkDuplicatedCode($code, $input, $id = null)
    {
        if(!isset($input['code']) || $input['code'] == '') return;
        $check = Model::where('option_id', $input['option_id'])->where('code', 'like', $input['code']);

        if($id) $check = $check->where('id','!=',$id);
        $check = $check->first();

        if ($check) abt($code, 'Duplicated option code!');
    }
}
