<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Hidable;
use Cosray\Field\Field;

class HiddenHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Hidable) {
			$field->hidden(true);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Hidable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Hidable) {
			return ['hidden' => $field->getHidden()];
		}

		return [];
	}
}
