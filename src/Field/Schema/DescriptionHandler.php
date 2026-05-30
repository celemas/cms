<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Describable;
use Cosray\Field\Field;

class DescriptionHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Describable) {
			$field->description($meta->description);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Describable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Describable) {
			return ['description' => $field->getDescription()];
		}

		return [];
	}
}
