<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Collection;

use Cosray\Collection;
use Cosray\Finder\Nodes;

final class TestArticlesCollection extends Collection
{
	protected static string $name = 'Test articles';
	protected static string $handle = 'test-articles';

	public function entries(): Nodes
	{
		return $this->cms
			->nodes()
			->types('test-article')
			->published(null)
			->hidden(null);
	}
}
