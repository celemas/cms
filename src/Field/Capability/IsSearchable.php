<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

use Cosray\Schema\FulltextWeight;

trait IsSearchable
{
	public function fulltext(FulltextWeight $fulltextWeight): static
	{
		$this->fulltextWeight = $fulltextWeight;

		return $this;
	}

	public function getFulltextWeight(): ?FulltextWeight
	{
		return $this->fulltextWeight;
	}
}
