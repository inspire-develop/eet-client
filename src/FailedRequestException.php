<?php

namespace SlevomatEET;

class FailedRequestException extends \Exception
{

	/** @var \SlevomatEET\EvidenceRequest */
	private $request;

	public function __construct(EvidenceRequest $request, \Throwable $previous)
	{
		parent::__construct('Request error: ' . $previous->getMessage(), $previous->getCode(), $previous);
		$this->request = $request;
	}

	public function getRequest()
	{
		return $this->request;
	}

}
