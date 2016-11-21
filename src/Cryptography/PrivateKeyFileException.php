<?php

namespace SlevomatEET\Cryptography;

class PrivateKeyFileException extends \Exception
{

	/**
	 * @var string
	 */
	private $privateKeyFile;

	public function __construct($privateKeyFile, \Exception $previous = null)
	{
		parent::__construct(sprintf(
			'Private key could not be loaded from file \'%s\'. Please make sure that the file contains valid private key in PEM format.',
			$privateKeyFile
		), 0, $previous);

		$this->privateKeyFile = $privateKeyFile;
	}

	public function getPrivateKeyFile()
	{
		return $this->privateKeyFile;
	}

}
