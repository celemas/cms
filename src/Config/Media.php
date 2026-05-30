<?php

declare(strict_types=1);

namespace Cosray\Config;

final class Media
{
	public function __construct(
		private readonly \Cosray\Config $config,
	) {}

	/** @var null|'apache'|'nginx' */
	public ?string $fileServer {
		get => $this->config->get('media.fileserver');
	}
}
