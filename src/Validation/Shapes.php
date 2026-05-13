<?php

declare(strict_types=1);

namespace Celemas\Cms\Validation;

use Celemas\Sire\Contract\Validator;
use Celemas\Sire\Extra;
use Celemas\Sire\Field;
use Celemas\Sire\Shape;

final class Shapes
{
	public static function create(): Shape
	{
		return self::configure(new Shape());
	}

	public static function list(): Shape
	{
		return self::configure(Shape::list());
	}

	public static function add(
		Shape $shape,
		string $field,
		string|Validator $type,
		string ...$rules,
	): Field {
		$definition = $shape->add($field, self::type($type));

		if ($rules !== []) {
			$definition->rules(...$rules);
		}

		if (!in_array('required', $rules, true)) {
			$definition
				->optional()
				->nullable();
		}

		return $definition;
	}

	private static function configure(Shape $shape): Shape
	{
		return $shape
			->rules(Validators::registry())
			->extra(Extra::Allow);
	}

	private static function type(string|Validator $type): string|Validator
	{
		return $type === 'text' ? 'string' : $type;
	}
}
