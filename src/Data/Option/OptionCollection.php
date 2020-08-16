<?php

namespace Bendt\Option\Data\Option;

use Bendt\Option\Models\Option;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Option $model) {
            return (new OptionResource($model))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}
