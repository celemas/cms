<?php

declare(strict_types=1);

namespace Cosray\Contract;

interface Icons
{
	public function icon(
		string $id,
		array $args = [],
	): string;
}
