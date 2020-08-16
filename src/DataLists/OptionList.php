<?php

namespace Bendt\Option\DataLists;

class OptionList {

	public static $mapping = [
	];

	public static $with_relations = [
		'index' => ['created_by','updated_by','deleted_by'],
		'common' => [],
	];

	public static function index() {
		return [
			'id' => 'multi',
			'name' => 'like',
			'description' => 'like',
			'slug' => 'like',
			'is_active' => 'like',
			'is_reserved' => 'like',
			'is_modifiable' => '=',
			'created_at' => 'like',
			'created_by_id' => 'multi',
			'updated_at' => 'like',
			'updated_by_id' => 'multi',
			'deleted_at' => 'like',
			'deleted_by_id' => 'multi',
		];
	}

	public static function common() {
		return [
			'id' => 'multi',
			'name' => 'like',
		];
	}

}