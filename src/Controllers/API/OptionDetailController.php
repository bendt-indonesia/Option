<?php

namespace Bendt\Option\Controllers\API;

use Bendt\Option\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Bendt\Option\Models\OptionDetail as Model;
use Bendt\Option\Models\Option;

use Bendt\Option\DataLists\OptionDetailList as DataList;
use Bendt\Option\Data\OptionDetail\RequestStoreOptionDetail;
use Bendt\Option\Data\OptionDetail\RequestUpdateOptionDetail;
use Bendt\Option\Data\OptionDetail\OptionDetailResource;
use Bendt\Option\Controllers\API\Traits\OptionDetailTrait;

class OptionDetailController extends ApiController
{
    use OptionDetailTrait;

    public $model;

    public function __construct(Option $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource OptionDetail
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $dataList = new DataList();
            $filters = checkListType($request, $dataList, true);
            $withs = checkWithRelations($request, $dataList, true);

            $models = Model::with($withs)->
				select(collect($filters)->keys()->all());

            if($request->input('deleted')) {
                $traits = class_uses(new Model);
                if(in_array('Illuminate\Database\Eloquent\SoftDeletes',$traits))
                $models->withTrashed();
            }

            return datatables($models)
				->filter(function ($query) use ($request, $filters) {
					filterDataTables($request, $filters, $query);
				})
                ->make(true);
        } catch (\Exception $e) {
            return $this->sendException($e);
        }
    }

    /**
     * Store a newly created OptionDetail resource in storage.
     *
     * @param \Bendt\Option\Data\OptionDetail\RequestStoreOptionDetail $request
     * @throws null
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOptionDetail $request)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('store', new Option);

            $input = $request->validated();

            $this->checkDuplicatedName('62101',$input);
            $this->checkDuplicatedCode('62102',$input);

            $model = new Model($input);

            $model->process($request->allFiles(),'create');

            $model->is_reserved = $model->option->is_reserved;
            $model->is_modifiable = $model->option->is_modifiable;
            $model->save();

			$this->clearCache($model);

            DB::commit();

            return $this->sendResponse((new OptionDetailResource($model))->additional([

            ]), null, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Display the specified resource OptionDetail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('view', new Option);

            $model = Model::find($id);

            $resource = new OptionDetailResource($model);
            DB::commit();

            return $this->sendResponse($resource, null, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Update the specified OptionDetail resource in storage.
     *
     * @param  \Bendt\Option\Data\OptionDetail\RequestUpdateOptionDetail $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdateOptionDetail $request, $id)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('update', new Option);

            $input = $request->validated();

            $this->checkDuplicatedName('62202',$input,$id);
            $this->checkDuplicatedCode('62203',$input,$id);

            $model = Model::find($id);
			$this->checkModifiable($model);

            $model->fill($input);
            $model->process($request->allFiles());

            $model->is_reserved = $model->option->is_reserved;
            $model->is_modifiable = $model->option->is_modifiable;
            $model->save();

			$this->clearCache($model);

            DB::commit();

            return $this->sendResponse((new OptionDetailResource($model))->additional([

            ]));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Remove the specified OptionDetail resource from storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('destroy', new Option);

            $model = Model::findOrFail($id);

			$this->checkModifiable($model);

            $model->remove();

			$this->clearCache($model);

            DB::commit();

            return $this->sendResponse([], null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Bulk Remove the specified ids OptionDetail resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroyBulk(Request $request)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('destroy', new Option);

            $this->validate($request, [
                'ids' => 'required|array',
            ]);

            $ids = $request->input('ids');

            $models = Model::whereIn('id',$ids)->get();

			$optionIds = $this->checkModifiableBulk($models);

            foreach($models as $model) {
                $model->remove();
            }

			$this->clearCacheBulk($optionIds);

            DB::commit();

            return $this->sendResponse([], null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }
}
