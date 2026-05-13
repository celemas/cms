<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value\Number as NumberValue;
use Celemas\Sire\Shape;

class Number extends Field
{
	public function value(): NumberValue
	{
		return new NumberValue($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('number', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:number');
		Shapes::add($shape, 'value', 'float', ...$this->validators);

		return $shape;
	}
}
