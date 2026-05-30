<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Labelable;
use Cosray\Field\Field;

class LabelHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Labelable) {
			$field->label($meta->label);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Labelable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Labelable) {
			return ['label' => $field->getLabel()];
		}

		return [];
	}
}
