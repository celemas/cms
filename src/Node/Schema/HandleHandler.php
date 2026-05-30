<?php

declare(strict_types=1);

namespace Cosray\Node\Schema;

class HandleHandler extends Handler
{
	public function resolve(object $meta, string $nodeClass): array
	{
		return ['handle' => $meta->value];
	}
}
