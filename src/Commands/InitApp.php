<?php

declare(strict_types=1);

namespace Cosray\Commands;

use Celemas\Cli\Command;

class InitApp extends Command
{
	protected string $group = 'General';
	protected string $name = 'init-app';
	protected string $description = 'Initialize the Cosray app';

	public function run(): int
	{
		return 0;
	}
}
