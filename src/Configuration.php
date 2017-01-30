<?php

namespace SlevomatEET;

class Configuration
{

	/** @var string */
	private $vatId;

	/** @var string */
	private $premiseId;

	/** @var string */
	private $cashRegisterId;

	/** @var bool */
	private $verificationMode;

	/** @var \SlevomatEET\EvidenceMode */
	private $evidenceMode;

	/** @var \SlevomatEET\EvidenceEnvironment */
	private $evidenceEnvironment;

	public function __construct($vatId, $premiseId, $cashRegisterId, EvidenceEnvironment $evidenceEnvironment, $verificationMode = false)
	{
		$this->vatId = $vatId;
		$this->premiseId = $premiseId;
		$this->cashRegisterId = $cashRegisterId;
		$this->evidenceMode = EvidenceMode::get(EvidenceMode::REGULAR);
		$this->verificationMode = $verificationMode;
		$this->evidenceEnvironment = $evidenceEnvironment;
	}

	public function getVatId()
	{
		return $this->vatId;
	}

	public function getPremiseId()
	{
		return $this->premiseId;
	}

	public function getCashRegisterId()
	{
		return $this->cashRegisterId;
	}

	public function isVerificationMode()
	{
		return $this->verificationMode;
	}

	public function getEvidenceMode()
	{
		return $this->evidenceMode;
	}

	public function getEvidenceEnvironment()
	{
		return $this->evidenceEnvironment;
	}

}
