<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;
use Cosray\Node\Contract\HasInit;
use Cosray\Schema\Label;
use Cosray\Schema\Route;

#[Label('Plain Page With Init')]
#[Route('/plain-page-with-init/{uid}')]
class PlainPageWithInit implements HasInit
{
	#[Label('Title')]
	protected Text $title;

	public bool $initialized = false;

	public function init(): void
	{
		$this->initialized = true;
	}

	public function title(): string
	{
		return $this->title?->value()->unwrap() ?? '';
	}
}
