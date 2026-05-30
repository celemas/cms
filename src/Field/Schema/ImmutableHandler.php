<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Immutable;
use Cosray\Field\Field;

class ImmutableHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Immutable) {
			$field->immutable(true);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Immutable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Immutable) {
			return ['immutable' => $field->getImmutable()];
		}

		return [];
	}
}
