<?php

namespace Bendt\Option\Data\Option;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource model Option into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'slug' => $this->slug,
			'is_active' => $this->is_active,
			'is_reserved' => $this->is_reserved,
			'is_modifiable' => $this->is_modifiable,
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
