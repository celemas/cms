<?php

declare(strict_types=1);

namespace Celemas\Cms\Field;

use Celemas\Cms\Validation\Shapes;
use Celemas\Cms\Value\Code as CodeValue;
use Celemas\Sire\Shape;

class Code extends Field implements Capability\Translatable, Capability\SyntaxAware
{
	use Capability\IsTranslatable;
	use Capability\IsSyntaxAware;

	public function value(): CodeValue
	{
		return new CodeValue($this->owner, $this, $this->valueContext);
	}

	public function structure(mixed $value = null): array
	{
		$syntax = $this->valueContext->data['syntax'] ?? $this->getDefaultSyntax();

		if (is_array($value) && array_key_exists('value', $value)) {
			$syntax = is_string($value['syntax'] ?? null) ? $value['syntax'] : $syntax;
			$value = $value['value'];
		}

		$result = $this->getTranslatableStructure('code', $value);
		$result['syntax'] = $syntax;

		return $result;
	}

	public function shape(): Shape
	{
		$shape = Shapes::create();
		Shapes::add($shape, 'type', 'text', 'required', 'in:code');
		Shapes::add($shape, 'syntax', 'text', 'required', 'in:' . implode(',', $this->getSyntaxes()));

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

	public function properties(): array
	{
		$result = parent::properties();
		$result['syntaxes'] = $this->getSyntaxes();

		return $result;
	}
}
