<?php

namespace Bendt\Option\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Option\Traits\BelongsToCreatedByTrait;
use Bendt\Option\Traits\BelongsToUpdatedByTrait;
use Bendt\Option\Traits\BelongsToDeletedByTrait;
use Bendt\Option\Traits\ScopeActiveTrait;

class Option extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'option';

	protected $processed = ['slug'];

	protected $softCascade = ['option_detail'];

	protected $with = ['option_detail'];

	protected $guarded = ['slug'];

	protected $files = [];

	const FILE_PATH = "/option/";

	public function option_detail() {
		return $this->hasMany(OptionDetail::class);
	}

}