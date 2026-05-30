<?php

declare(strict_types=1);

namespace Cosray\Field;

use Celemas\Sire\Shape;
use Cosray\Validation\Shapes;
use Cosray\Value\Str;

class Radio extends Field
{
	public function value(): Str
	{
		return new Str($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('radio', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		$shape->add('type', 'string')->rules('required', 'in:radio');

		$value = $shape->add('value', 'string')->rules(...$this->validators);

		if (!$this->isRequired()) {
			$value->optional()->nullable();
		}

		return $shape;
	}
}
