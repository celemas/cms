<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Node\Contract\Title;
use Cosray\Schema\Label;

#[Label('Node With Custom Name Attribute')]
class NodeWithNameAttribute implements Title
{
	public function title(): string
	{
		return 'with name';
	}
}
