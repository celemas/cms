<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures;

use Celemas\Quma\Connection;
use Celemas\Quma\Contract\Migration;
use Celemas\Quma\Database;
use Celemas\Quma\Environment;
use Override;

final class ContainerMigration implements Migration
{
	public function __construct(
		public readonly MigrationFactoryDependency $dependency,
		public readonly Environment $env,
		public readonly Connection $conn,
		public readonly Database $db,
	) {}

	#[Override]
	public function run(Environment $env): void {}
}
