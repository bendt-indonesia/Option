<?php

namespace Bendt\Option\Data\OptionDetail;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionDetailResource extends JsonResource
{
    /**
     * Transform the resource model OptionDetail into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
			'option_id' => $this->option_id,
			'option' => $this->option,
			'name' => $this->name,
			'value' => $this->value,
			'code' => $this->code,
			'created_at' => $this->created_at,
			'created_by_id' => $this->created_by_id,
			'created_by' => $this->created_by,
			'updated_at' => $this->updated_at,
			'updated_by_id' => $this->updated_by_id,
			'updated_by' => $this->updated_by,
			'deleted_at' => $this->deleted_at,
			'deleted_by_id' => $this->deleted_by_id,
			'deleted_by' => $this->deleted_by,
        ];
    }
}
