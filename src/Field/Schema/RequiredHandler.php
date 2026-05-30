<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Requirable;
use Cosray\Field\Field;

class RequiredHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Requirable) {
			$field->required(true);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Requirable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Requirable) {
			return ['required' => $field->isRequired()];
		}

		return [];
	}
}
