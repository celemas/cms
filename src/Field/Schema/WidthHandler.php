<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\Resizable;
use Cosray\Field\Field;

class WidthHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof Resizable) {
			$field->width($meta->width);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, Resizable::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof Resizable) {
			return ['width' => $field->getWidth()];
		}

		return [];
	}
}
