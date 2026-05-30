<?php

declare(strict_types=1);

namespace Cosray\Schema;

use Attribute;

#[Attribute]
class Handle
{
	public function __construct(
		public readonly string $value,
	) {}
}
