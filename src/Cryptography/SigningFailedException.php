<?php

namespace SlevomatEET\Cryptography;

class SigningFailedException extends \Exception
{

	/**
	 * @var mixed[]
	 */
	private $data;

	public function __construct(array $data)
	{
		parent::__construct('Signing failed');

		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

}
