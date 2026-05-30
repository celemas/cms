<?php

declare(strict_types=1);

namespace Cosray\Schema;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class Title
{
	public function __construct(
		public readonly string $field = '',
	) {}
}
