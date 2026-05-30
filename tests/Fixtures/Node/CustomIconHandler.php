<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Node\Schema\Handler;

class CustomIconHandler extends Handler
{
	public function resolve(object $meta, string $nodeClass): array
	{
		return ['icon' => $meta->value];
	}
}
