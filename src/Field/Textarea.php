<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Sire\Shape;

class Textarea extends Text implements Capability\Translatable
{
	use Capability\IsTranslatable;

	public function structure(mixed $value = null): array
	{
		return $this->getTranslatableStructure('textarea', $value);
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:textarea');

		if ($this->translate) {
			$locales = $this->owner->locales();
			$defaultLocale = $locales->getDefault()->id;
			$i18nShape = Shapes::create();

			foreach ($locales as $locale) {
				$localeValidators = [];

				if ($this->isRequired() && $locale->id === $defaultLocale) {
					$localeValidators[] = 'required';
				}

				Shapes::add($i18nShape, $locale->id, 'text', ...$localeValidators);
			}

			Shapes::add($shape, 'value', $i18nShape, ...$this->validators);
		} else {
			Shapes::add($shape, 'value', 'text', ...$this->validators);
		}

		return $shape;
	}
}
