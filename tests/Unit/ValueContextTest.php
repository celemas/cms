<?php

declare(strict_types=1);

namespace Cosray\Tests\Unit;

use Cosray\Tests\TestCase;
use Cosray\Value\ValueContext;

/**
 * @internal
 *
 * @coversNothing
 */
final class ValueContextTest extends TestCase
{
	public function testValueContextStoresFieldNameAndData(): void
	{
		$context = new ValueContext('title', ['value' => 'Hello']);

		$this->assertSame('title', $context->fieldName);
		$this->assertSame(['value' => 'Hello'], $context->data);
	}
}
