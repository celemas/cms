<?php

declare(strict_types=1);

namespace Cosray\Field;

use Celemas\Sire\Shape;
use Cosray\Validation\Shapes;
use Cosray\Value\Boolean;

class Checkbox extends Field
{
	public function value(): Boolean
	{
		return new Boolean($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('checkbox', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		$shape->add('type', 'string')->rules('required', 'in:checkbox');

		$value = $shape->add('value', 'bool')->rules(...$this->validators);

		if (!$this->isRequired()) {
			$value->optional()->nullable();
		}

		return $shape;
	}
}
