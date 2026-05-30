<?php

declare(strict_types=1);

namespace Cosray\Field;

use Celemas\Sire\Shape;
use Cosray\Validation\Shapes;
use Cosray\Value\Number as NumberValue;

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
		$shape->add('type', 'string')->rules('required', 'in:number');

		$value = $shape->add('value', 'float')->rules(...$this->validators);

		if (!$this->isRequired()) {
			$value->optional()->nullable();
		}

		return $shape;
	}
}
