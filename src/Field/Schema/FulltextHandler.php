<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Searchable;
use Cosray\Field\Field;

class FulltextHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Searchable) {
			$field->fulltext($meta->fulltextWeight);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Searchable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		return [];
	}
}
