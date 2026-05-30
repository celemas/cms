<?php

declare(strict_types=1);

namespace Cosray;

use Celemas\Container\Container;
use Celemas\Quma\Connection;
use Celemas\Quma\Contract\Migration;
use Celemas\Quma\Contract\MigrationFactory as QumaMigrationFactory;
use Celemas\Quma\Database;
use Celemas\Quma\Environment;
use Override;
use UnexpectedValueException;

final class MigrationFactory implements QumaMigrationFactory
{
	public function __construct(
		protected readonly Container $container,
	) {}

	/** @param class-string<Migration> $class */
	#[Override]
	public function create(string $class, Environment $env): Migration
	{
		$container = $this->container->scope();
		$container->add(Environment::class, $env)->value();
		$container->add(Connection::class, $env->conn)->value();
		$container->add(Database::class, $env->db)->value();

		$migration = $container->get($class);

		if (!$migration instanceof Migration) {
			throw new UnexpectedValueException("Migration factory must create instances of {$class}");
		}

		return $migration;
	}
}
