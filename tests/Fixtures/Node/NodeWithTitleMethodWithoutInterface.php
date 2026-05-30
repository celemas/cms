<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;

class NodeWithTitleMethodWithoutInterface
{
	public Text $title;

	public function title(): string
	{
		return 'Method title should not be used';
	}
}
