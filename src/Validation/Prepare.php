<?php

declare(strict_types=1);

namespace Cosray\Validation;

final class Prepare
{
	public static function nullAsEmpty(mixed $value): mixed
	{
		return $value ?? [];
	}
}
