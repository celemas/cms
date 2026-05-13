<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value\Boolean;
use Celemas\Sire\Shape;

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
		Shapes::add($shape, 'type', 'text', 'required', 'in:checkbox');
		Shapes::add($shape, 'value', 'bool', ...$this->validators);

		return $shape;
	}
}
