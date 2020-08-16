<?php

namespace Bendt\Option\Data\OptionDetail;

use Bendt\Option\Models\OptionDetail;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (OptionDetail $model) {
            return (new OptionDetailResource($model))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}
