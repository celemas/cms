<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Prepare;
use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value;
use Celemas\Sire\Shape;

class Picture extends Field implements
	Capability\Limitable,
	Capability\File\Translatable,
	Capability\Translatable
{
	use Capability\IsLimitable;
	use Capability\File\IsTranslatable;
	use Capability\IsTranslatable;

	// TODO: translateFile and multiple
	public function value(): Value\Picture
	{
		if ($this->translateFile) {
			return new Value\TranslatedPicture($this->owner, $this, $this->valueContext);
		}

		return new Value\Picture($this->owner, $this, $this->valueContext);
	}

	public function properties(): array
	{
		$value = $this->value();
		$count = $value->count();

		// Generate thumbs
		// TODO: add it to the api data. Currently we assume in the frontend that they are existing
		for ($i = 0; $i < $count; $i++) {
			$value->width(400)->url(false, $i);
		}

		return parent::properties();
	}

	public function structure(mixed $value = null): array
	{
		return $this->getFileStructure('picture', $value);
	}

	public function shape(): Shape
	{
		$limitValidators = $this->limitValidators();
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:picture');

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
