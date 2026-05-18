<?php

declare(strict_types=1);

namespace Celemas\Cms\Tests\Unit;

use Celemas\Cms\MigrationFactory;
use Celemas\Cms\Tests\Fixtures\ContainerMigration;
use Celemas\Cms\Tests\Fixtures\MigrationFactoryDependency;
use Celemas\Cms\Tests\TestCase;
use Celemas\Container\Container;
use Celemas\Quma\Connection;
use Celemas\Quma\Environment;

/**
 * @internal
 *
 * @coversNothing
 */
final class MigrationFactoryTest extends TestCase
{
	public function testCreatesMigrationWithScopedEnvironment(): void
	{
		$container = new Container();
		$dependency = new MigrationFactoryDependency();
		$container->add(MigrationFactoryDependency::class, $dependency)->value();

		$env = new Environment([
			'default' => new Connection('sqlite::memory:', self::root() . '/db/sql'),
		], []);

		$migration = new MigrationFactory($container)->create(ContainerMigration::class, $env);

		$this->assertInstanceOf(ContainerMigration::class, $migration);
		$this->assertSame($dependency, $migration->dependency);
		$this->assertSame($env, $migration->env);
		$this->assertSame($env->conn, $migration->conn);
		$this->assertSame($env->db, $migration->db);
	}
}
