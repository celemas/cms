<?php

declare(strict_types=1);

namespace Cosray\Schema;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Deletable
{
	public function __construct(
		public readonly bool $value = true,
	) {}
}
