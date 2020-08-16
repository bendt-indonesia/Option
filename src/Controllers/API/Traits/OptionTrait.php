<?php

namespace Bendt\Option\Controllers\API\Traits;

use Bendt\Option\Models\Option as Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait OptionTrait
{

    /**
     * Display
     *
     * @param \Illuminate\Http\Request $request
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function key(Request $request, $key)
    {
        try {
            $data = option($key);
            return $this->sendResponse($data->option_detail);
        } catch (\Exception $e) {
            return $this->sendException($e);
        }
    }

    /**
     * Display a listing of the province
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        try {
            $slug = $request->input('slug');
            if(!$slug) return $this->sendError($slug.' not Found!');

            $models = Model::where('slug',$slug)->where('is_active',1)->first();

            return datatables($models->option_detail)
                ->make(true);
        } catch (\Exception $e) {
            return $this->sendException($e);
        }
    }

    /**
     * Check is option modifiable or not
     *
     * @param Model $model
     * @throws \Exception
     * @return Boolean
     */
    public function checkModifiable($model)
    {
        if(!$model->is_modifiable) {
            abt('61201','This option is reserved by system and may not be modify.');
        }

        return true;
    }

    /**
     * Check is option delete able or not
     *
     * @param Model $model
     * @throws \Exception
     * @return Boolean
     */
    public function checkDeleteAble($model)
    {
        if($model->is_reserved) {
            abt('61301','Cannot delete reserved system options');
        }

        return true;
    }

    /**
     * Check is option delete able (bulk) or not
     *
     * @param Object $models
     * @throws \Exception
     * @return Boolean
     */
    public function checkDeleteAbleBulk($models)
    {
        foreach ($models as $model) {
            $this->checkDeleteAble($model);
        }
        return true;
    }
}
