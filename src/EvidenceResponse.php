<?php

namespace SlevomatEET;

class EvidenceResponse
{

	/** @var \stdClass */
	private $rawData;

	/** @var string|null */
	private $uuid;

	/** @var string|null */
	private $bkp;

	/** @var bool */
	private $test;

	/** @var string|null */
	private $fik;

	/** @var \DateTimeImmutable */
	private $responseTime;

	/** @var \SlevomatEET\EvidenceRequest */
	private $evidenceRequest;

	public function __construct(\stdClass $rawData, EvidenceRequest $evidenceRequest)
	{
		$this->rawData = $rawData;
		$this->uuid = isset($rawData->Hlavicka->uuid_zpravy) ? $rawData->Hlavicka->uuid_zpravy : null;
		if (isset($rawData->Potvrzeni)) {
			$this->fik = $rawData->Potvrzeni->fik;
		}
		$this->bkp = isset($rawData->Hlavicka->bkp) ? $rawData->Hlavicka->bkp : null;
		if (isset($rawData->Potvrzeni->test)) {
			$this->test = $rawData->Potvrzeni->test;
		} else if (isset($rawData->Chyba->test)) {
			$this->test = $rawData->Chyba->test;
		} else {
			$this->test = false;
		}
		$this->responseTime = \DateTimeImmutable::createFromFormat(\DateTime::ISO8601, isset($rawData->Hlavicka->dat_prij) ? $rawData->Hlavicka->dat_prij : $rawData->Hlavicka->dat_odmit);
		$this->evidenceRequest = $evidenceRequest;
	}

	public function getFik()
	{
		if (!$this->isValid()) {
			throw new InvalidResponseWithoutFikException($this);
		}

		return $this->fik;
	}

	public function getRawData()
	{
		return $this->rawData;
	}

	/**
	 * @return string|null
	 */
	public function getUuid()
	{
		return $this->uuid;
	}

	/**
	 * @return string|null
	 */
	public function getBkp()
	{
		return $this->bkp;
	}

	public function isTest()
	{
		return $this->test;
	}

	public function isValid()
	{
		return $this->fik !== null;
	}

	public function getResponseTime()
	{
		return $this->responseTime;
	}

	public function getRequest()
	{
		return $this->evidenceRequest;
	}

}
