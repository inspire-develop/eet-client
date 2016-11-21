<?php

namespace SlevomatEET;

use SlevomatEET\Type\Enum;

class EvidenceEnvironment extends Enum
{

	const PLAYGROUND = 'playground';
	const PRODUCTION = 'production';

	public function getWsdlPath()
	{
		if ($this->equalsValue(self::PRODUCTION)) {
			return __DIR__ . '/../wsdl/EETServiceSOAP_production.wsdl';
		}
		return __DIR__ . '/../wsdl/EETServiceSOAP_playground.wsdl';
	}

}
