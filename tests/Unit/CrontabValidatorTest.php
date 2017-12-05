<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\CrontabValidator\Tests\Unit;

use hollodotme\CrontabValidator\CrontabValidator;
use hollodotme\CrontabValidator\Exceptions\InvalidCrontabInterval;
use PHPUnit\Framework\TestCase;

/**
 * Class CrontabValidatorTest
 * @package hollodotme\CrontabValidator\Tests\Unit
 */
class CrontabValidatorTest extends TestCase
{
	/**
	 * @param string $crontabInterval
	 *
	 * @dataProvider validIntervalProvider
	 * @throws InvalidCrontabInterval
	 */
	public function testIntervalIsValid( string $crontabInterval )
	{
		$validator = new CrontabValidator();

		$this->assertTrue( $validator->isIntervalValid( $crontabInterval ) );

		$validator->guardIntervalIsValid( $crontabInterval );
	}

	public function validIntervalProvider() : array
	{
		return require __DIR__ . '/data/ValidCrontabIntervals.php';
	}

	/**
	 * @param string $crontabInterval
	 *
	 * @dataProvider invalidIntervalProvider
	 */
	public function testIntervalIsInValid( string $crontabInterval )
	{
		$validator = new CrontabValidator();

		$this->assertFalse( $validator->isIntervalValid( $crontabInterval ) );
	}

	public function invalidIntervalProvider() : array
	{
		return require __DIR__ . '/data/InvalidCrontabIntervals.php';
	}

	/**
	 * @throws InvalidCrontabInterval
	 */
	public function testInvalidIntervalThrowsException()
	{
		$this->expectException( InvalidCrontabInterval::class );

		(new CrontabValidator())->guardIntervalIsValid( ' abc def hij klm nop ' );
	}
}
