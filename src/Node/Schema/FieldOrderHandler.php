<?php

declare(strict_types=1);

namespace Cosray\Node\Schema;

class FieldOrderHandler extends Handler
{
	public function resolve(object $meta, string $nodeClass): array
	{
		return ['fieldOrder' => $meta->fields];
	}
}
