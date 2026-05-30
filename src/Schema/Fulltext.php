<?php

declare(strict_types=1);

namespace Cosray\Schema;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
readonly class Fulltext
{
	public function __construct(
		public FulltextWeight $fulltextWeight,
	) {}
}
