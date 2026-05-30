<?php

declare(strict_types=1);

namespace Cosray\Field\Schema;

use Cosray\Exception\RuntimeException;
use Cosray\Field\Capability\SyntaxAware;
use Cosray\Field\Field;

class SyntaxHandler extends Handler
{
	public function apply(object $meta, Field $field): void
	{
		if ($field instanceof SyntaxAware) {
			$field->syntaxes($meta->syntaxes);

			return;
		}

		throw new RuntimeException($this->capabilityErrorMessage($field, SyntaxAware::class));
	}

	public function properties(object $meta, Field $field): array
	{
		if ($field instanceof SyntaxAware) {
			return ['syntaxes' => $field->getSyntaxes()];
		}

		return [];
	}
}
