<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Node\Contract\Title;
use Cosray\Schema\Render;

#[Render('template-defined-by-render-attribute')]
class NodeWithRenderAttribute implements Title
{
	public function title(): string
	{
		return 'with render';
	}
}
