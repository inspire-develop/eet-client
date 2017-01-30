<?php

namespace SlevomatEET;

class InvalidResponseWithoutFikException extends \Exception
{

	/** @var \SlevomatEET\EvidenceResponse */
	private $response;

	public function __construct(EvidenceResponse $response, \Exception $previous = null)
	{
		parent::__construct('Missing FIK in response', 0, $previous);
		$this->response = $response;
	}

	public function getResponse()
	{
		return $this->response;
	}

}
