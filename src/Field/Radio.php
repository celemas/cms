<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value\Str;
use Celemas\Sire\Shape;

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
		Shapes::add($shape, 'type', 'text', 'required', 'in:radio');
		Shapes::add($shape, 'value', 'text', ...$this->validators);

		return $shape;
	}
}
