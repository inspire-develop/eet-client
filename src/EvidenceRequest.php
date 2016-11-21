<?php

namespace SlevomatEET;

use SlevomatEET\Cryptography\CryptographyService;

class EvidenceRequest
{

	/** @var \DateTimeImmutable */
	private $sendDate;

	/** @var mixed[] */
	private $header;

	/** @var mixed[] */
	private $body;

	/** @var string */
	private $pkpCode;

	/** @var string */
	private $bkpCode;

	public function __construct(Receipt $receipt, Configuration $configuration, CryptographyService $cryptographyService)
	{
		$this->sendDate = new \DateTimeImmutable();
		$this->header = [
			'uuid_zpravy' => $receipt->getUuid()->toString(),
			'dat_odesl' => Formatter::formatDateTime($this->sendDate),
			'prvni_zaslani' => $receipt->isFirstSend(),
			'overeni' => $configuration->isVerificationMode(),
		];

		$body = [
			'dic_popl' => $configuration->getVatId(),
			'dic_poverujiciho' => $receipt->getDelegatedVatId(),
			'id_provoz' => $configuration->getPremiseId(),
			'id_pokl' => $configuration->getCashRegisterId(),
			'porad_cis' => $receipt->getReceiptNumber(),
			'dat_trzby' => Formatter::formatDateTime($receipt->getReceiptTime()),
			'celk_trzba' => Formatter::formatAmount($receipt->getTotalPrice()),
			'zakl_nepodl_dph' => Formatter::formatAmount($receipt->getPriceZeroVat()),
			'zakl_dan1' => Formatter::formatAmount($receipt->getPriceStandardVat()),
			'dan1' => Formatter::formatAmount($receipt->getVatStandard()),
			'zakl_dan2' => Formatter::formatAmount($receipt->getPriceFirstReducedVat()),
			'dan2' => Formatter::formatAmount($receipt->getVatFirstReduced()),
			'zakl_dan3' => Formatter::formatAmount($receipt->getPriceSecondReducedVat()),
			'dan3' => Formatter::formatAmount($receipt->getVatSecondReduced()),
			'cest_sluz' => Formatter::formatAmount($receipt->getPriceTravelService()),
			'pouzit_zboz1' => Formatter::formatAmount($receipt->getPriceUsedGoodsStandardVat()),
			'pouzit_zboz2' => Formatter::formatAmount($receipt->getPriceUsedGoodsFirstReduced()),
			'pouzit_zboz3' => Formatter::formatAmount($receipt->getPriceUsedGoodsSecondReduced()),
			'urceno_cerp_zuct' => Formatter::formatAmount($receipt->getPriceForSubsequentSettlement()),
			'cerp_zuct' => Formatter::formatAmount($receipt->getPriceUsedSubsequentSettlement()),
			'rezim' => $configuration->getEvidenceMode()->getValue(),
		];
		$this->body = array_filter($body, function ($value) {
			return $value !== null;
		});

		$this->pkpCode = $cryptographyService->getPkpCode($this->body);
		$this->bkpCode = $cryptographyService->getBkpCode($this->pkpCode);
	}

	public function getRequestData()
	{
		return [
			'Hlavicka' => $this->header,
			'Data' => $this->body,
			'KontrolniKody' => [
				'pkp' => [
					'_' => $this->pkpCode,
					'digest' => 'SHA256',
					'cipher' => 'RSA2048',
					'encoding' => 'base64',
				],
				'bkp' => [
					'_' => $this->bkpCode,
					'digest' => 'SHA1',
					'encoding' => 'base16',
				],
			],
		];
	}

	public function getSendDate()
	{
		return $this->sendDate;
	}

	public function getHeader()
	{
		return $this->header;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function getPkpCode()
	{
		return $this->pkpCode;
	}

	public function getBkpCode()
	{
		return $this->bkpCode;
	}

}
