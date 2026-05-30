<?php

declare(strict_types=1);

namespace Cosray\Field;

use Celemas\Sire\Shape;
use Cosray\Validation\Shapes;
use Cosray\Value\DateTime as DateTimeValue;

class DateTime extends Field
{
	public function value(): DateTimeValue
	{
		return new DateTimeValue($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('datetime', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		$shape->add('type', 'string')->rules('required', 'in:datetime');

		$value = $shape->add('value', 'string')->rules(...$this->validators);

		if (!$this->isRequired()) {
			$value->optional()->nullable();
		}

		return $shape;
	}
}
