<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Prepare;
use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value;
use Celemas\Sire\Shape;

class Image extends Field implements
	Capability\Translatable,
	Capability\File\Translatable,
	Capability\Limitable
{
	use Capability\IsLimitable;
	use Capability\IsTranslatable;
	use Capability\File\IsTranslatable;

	public function value(): Value\Images|Value\Image
	{
		if ($this->allowsMultipleItems()) {
			if ($this->translateFile) {
				return new Value\TranslatedImages($this->owner, $this, $this->valueContext);
			}

			return new Value\Images($this->owner, $this, $this->valueContext);
		}

		if ($this->translateFile) {
			return new Value\TranslatedImage($this->owner, $this, $this->valueContext);
		}

		return new Value\Image($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		if ($this->translateFile) {
			return $this->getTranslatableFileStructure('image', $value);
		}

		return $this->getFileStructure('image', $value);
	}

	public function shape(): Shape
	{
		$limitValidators = $this->limitValidators();
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:image');

		if ($this->translateFile) {
			// File-translatable: separate file arrays per locale
			$subShape = Shapes::list();
			Shapes::add($subShape, 'file', 'text');
			Shapes::add($subShape, 'title', 'text');
			Shapes::add($subShape, 'alt', 'text');

			$i18nShape = Shapes::create();
			$locales = $this->owner->locales();

			foreach ($locales as $locale) {
				Shapes::add($i18nShape, $locale->id, $subShape, ...$limitValidators)
					->prepare(Prepare::nullAsEmpty(...));
			}

			Shapes::add($shape, 'files', $i18nShape, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		} elseif ($this->translate) {
			// Text-translatable: shared files but translatable titles and alt text
			$fileShape = Shapes::list();
			Shapes::add($fileShape, 'file', 'text', 'required');

			$locales = $this->owner->locales();
			$titleShape = Shapes::create();
			$altShape = Shapes::create();

			foreach ($locales as $locale) {
				Shapes::add($titleShape, $locale->id, 'text');
				Shapes::add($altShape, $locale->id, 'text');
			}

			Shapes::add($fileShape, 'title', $titleShape)->prepare(Prepare::nullAsEmpty(...));
			Shapes::add($fileShape, 'alt', $altShape)->prepare(Prepare::nullAsEmpty(...));
			Shapes::add($shape, 'files', $fileShape, ...$limitValidators, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		} else {
			// Non-translatable
			$fileShape = Shapes::list();
			Shapes::add($fileShape, 'file', 'text', 'required');
			Shapes::add($fileShape, 'title', 'text');
			Shapes::add($fileShape, 'alt', 'text');
			Shapes::add($shape, 'files', $fileShape, ...$limitValidators, ...$this->validators)
				->prepare(Prepare::nullAsEmpty(...));
		}

		return $shape;
	}
}
