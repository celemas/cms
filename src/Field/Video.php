<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Prepare;
use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value;
use Celemas\Sire\Shape;

class Video extends Field implements
	Capability\Limitable,
	Capability\File\Translatable,
	Capability\Translatable
{
	use Capability\IsLimitable;
	use Capability\File\IsTranslatable;
	use Capability\IsTranslatable;

	public function value(): Value\Video
	{
		if ($this->translateFile) {
			return new Value\Video($this->owner, $this, $this->valueContext);
		}

		return new Value\Video($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		if ($this->translateFile) {
			return $this->getTranslatableFileStructure('video', $value);
		}

		return $this->getFileStructure('video', $value);
	}

	public function shape(): Shape
	{
		$limitValidators = $this->limitValidators();
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:video');

		if ($this->translateFile) {
			// File-translatable: separate file arrays per locale
			$subShape = Shapes::list();
			Shapes::add($subShape, 'file', 'text');
			Shapes::add($subShape, 'title', 'text');

			$i18nShape = Shapes::create();
			$locales = $this->owner->locales();

			foreach ($locales as $locale) {
				Shapes::add($i18nShape, $locale->id, $subShape, ...$limitValidators)
					->prepare(Prepare::nullAsEmpty(...));
			}

			Shapes::add($shape, 'files', $i18nShape, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		} elseif ($this->translate) {
			// Text-translatable: shared files but translatable titles
			$fileShape = Shapes::list();
			Shapes::add($fileShape, 'file', 'text', 'required');

			$locales = $this->owner->locales();
			$defaultLocale = $locales->getDefault()->id;
			$titleShape = Shapes::create();

			foreach ($locales as $locale) {
				$localeValidators = [];

				if ($this->isRequired() && $locale->id === $defaultLocale) {
					$localeValidators[] = 'required';
				}

				Shapes::add($titleShape, $locale->id, 'text', ...$localeValidators);
			}

			Shapes::add($fileShape, 'title', $titleShape)->prepare(Prepare::nullAsEmpty(...));
			Shapes::add($shape, 'files', $fileShape, ...$limitValidators, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		} else {
			// Non-translatable
			$fileShape = Shapes::list();
			Shapes::add($fileShape, 'file', 'text', 'required');
			Shapes::add($fileShape, 'title', 'text');
			Shapes::add($shape, 'files', $fileShape, ...$limitValidators, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		}

		return $shape;
	}
}
