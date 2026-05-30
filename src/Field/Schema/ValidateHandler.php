<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Validatable;
use Cosray\Field\Field;

class ValidateHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Validatable) {
			$field->addValidators(...$meta->validators);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Validatable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Validatable) {
			return ['validators' => $field->validators()];
		}

		return [];
	}
}
