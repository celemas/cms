<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value\Time as TimeValue;
use Celemas\Sire\Shape;

class Time extends Field
{
	public function value(): TimeValue
	{
		return new TimeValue($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		return $this->getSimpleStructure('time', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:time');
		Shapes::add($shape, 'value', 'text', ...$this->validators);

		return $shape;
	}
}
