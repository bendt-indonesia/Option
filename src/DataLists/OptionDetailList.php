<?php

namespace Bendt\Option\DataLists;

class OptionDetailList {

	public static $mapping = [
	];

	public static $with_relations = [
		'index' => ['option','created_by','updated_by','deleted_by'],
		'common' => [],
	];

	public static function index() {
		return [
			'id' => 'multi',
			'option_id' => 'multi',
			'name' => 'like',
			'value' => 'like',
			'code' => 'like',
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