<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Selectable;
use Cosray\Field\Field;

class OptionsHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Selectable) {
			$field->options($meta->options);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Selectable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Selectable) {
			return ['options' => $field->getOptions()];
		}

		return [];
	}
}
