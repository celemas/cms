<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

use Cosray\Schema\FulltextWeight;

interface Searchable
{
	public function fulltext(FulltextWeight $fulltextWeight): static;

	public function getFulltextWeight(): ?FulltextWeight;
}
