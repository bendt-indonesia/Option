<?php

namespace App\Http\Controllers\API;

use Bendt\Option\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Bendt\Option\Models\Option as Model;

use Bendt\Option\DataLists\OptionList as DataList;
use Bendt\Option\Data\Option\RequestStoreOption;
use Bendt\Option\Data\Option\RequestUpdateOption;
use Bendt\Option\Data\Option\OptionResource;

use Bendt\Option\Controllers\API\Traits\OptionTrait;

class OptionController extends ApiController
{
    use OptionTrait;

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource Option
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
     * Store a newly created Option resource in storage.
     *
     * @param \Bendt\Option\Data\Option\RequestStoreOption $request
     * @throws null
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOption $request)
    {
        try {

            DB::beginTransaction();

            if( config('bendt-option.access_role', false) ) $this->authorize('store', $this->model);
            
            $model = new Model($request->validated());
            
            $model->process($request->allFiles(),'create');
            
            DB::commit();

            return $this->sendResponse((new OptionResource($model))->additional([

            ]), null, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Display the specified resource Option.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            DB::beginTransaction();
            
            $model = Model::find($id);
            if( config('bendt-option.access_role', false) ) $this->authorize('view', $model);
            
            $resource = new OptionResource($model);
            DB::commit();

            return $this->sendResponse($resource, null, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Update the specified Option resource in storage.
     *
     * @param  \Bendt\Option\Data\Option\RequestUpdateOption $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdateOption $request, $id)
    {
        try {

            DB::beginTransaction();
            
            $model = Model::find($id);
            if( config('bendt-option.access_role', false) ) $this->authorize('update', $model);
            
			$this->checkModifiable($model);

            $model->fill($request->validated());
            $model->process($request->allFiles());
            
            DB::commit();

            return $this->sendResponse((new OptionResource($model))->additional([

            ]));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Remove the specified Option resource from storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            DB::beginTransaction();
            if( config('bendt-option.access_role', false) ) $this->authorize('destroy', $this->model);
            $model = Model::findOrFail($id);
            
            
			$this->checkDeleteAble($model);

            $model->remove();
            
            DB::commit();

            return $this->sendResponse([], null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }

    /**
     * Bulk Remove the specified ids Option resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroyBulk(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->validate($request, [
                'ids' => 'required|array',
            ]);

            $ids = $request->input('ids');
            
            $models = Model::whereIn('id',$ids)->get();
            if( config('bendt-option.access_role', false) ) $this->authorize('destroy', $this->model);
            
			$this->checkDeleteAbleBulk($models);

            foreach($models as $model) {
                $model->remove();
            }
            
            DB::commit();

            return $this->sendResponse([], null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendException($e);
        }
    }
}
