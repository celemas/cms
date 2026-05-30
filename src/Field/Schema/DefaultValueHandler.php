<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Defaultable;
use Cosray\Field\Field;

class DefaultValueHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Defaultable) {
			$default = $meta->default;
			$field->default(is_callable($default) ? $default() : $default);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Defaultable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		return [];
	}
}
