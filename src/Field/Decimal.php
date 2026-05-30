<?php

declare(strict_types=1);

namespace Cosray\Field;

use Celemas\Sire\Shape;
use Cosray\Validation\Shapes;
use Cosray\Value\Decimal as DecimalValue;

class Decimal extends Field
{
	public function value(): DecimalValue
	{
		return new DecimalValue($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('decimal', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		$shape->add('type', 'string')->rules('required', 'in:decimal');

		$value = $shape->add('value', 'string')->rules(...$this->validators);

		if (!$this->isRequired()) {
			$value->optional()->nullable();
		}

		return $shape;
	}
}
