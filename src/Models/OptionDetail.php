<?php

namespace Bendt\Option\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Option\Traits\BelongsToCreatedByTrait;
use Bendt\Option\Traits\BelongsToUpdatedByTrait;
use Bendt\Option\Traits\BelongsToDeletedByTrait;
use Bendt\Option\Traits\ScopeActiveTrait;

class OptionDetail extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'option_details';

	protected $files = [];

	const FILE_PATH = "/option_details/";

	public function option() {
		return $this->belongsTo(Option::class);
	}

}