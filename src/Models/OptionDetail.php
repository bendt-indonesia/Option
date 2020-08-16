<?php

namespace Bendt\Option\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToCreatedByTrait;
use App\Traits\BelongsToUpdatedByTrait;
use App\Traits\BelongsToDeletedByTrait;
use App\Traits\ScopeActiveTrait;

class OptionDetail extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'option_details';

	protected $files = [];

	const FILE_PATH = "/option_details/";

	public function option() {
		return $this->belongsTo(Option::class);
	}

}