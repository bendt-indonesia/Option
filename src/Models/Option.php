<?php

namespace Bendt\Option\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToCreatedByTrait;
use App\Traits\BelongsToUpdatedByTrait;
use App\Traits\BelongsToDeletedByTrait;
use App\Traits\ScopeActiveTrait;

class Option extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'options';

	protected $processed = ['slug'];

	protected $softCascade = ['option_details'];

	protected $with = ['option_details'];

	protected $guarded = ['slug'];

	protected $files = [];

	const FILE_PATH = "/option/";

	public function option_details() {
		return $this->hasMany(OptionDetail::class);
	}

}