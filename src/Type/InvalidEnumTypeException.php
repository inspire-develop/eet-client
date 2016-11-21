<?php

namespace SlevomatEET\Type;

class InvalidEnumTypeException extends \InvalidArgumentException
{

	/** @var \SlevomatEET\Type\Enum */
	private $enum;

	/** @var string */
	private $expectedClass;

	public function __construct(Enum $enum, $expectedClass)
	{
		parent::__construct(sprintf(
			'Invalid enum type \'%s\'. Expected class: %s',
			get_class($enum),
			$expectedClass
		));

		$this->enum = $enum;
		$this->expectedClass = $expectedClass;
	}

	public function getEnum()
	{
		return $this->enum;
	}

	public function getExpectedClass()
	{
		return $this->expectedClass;
	}

}
