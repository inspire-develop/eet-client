<?php

namespace SlevomatEET\Driver;

class DriverRequestFailedException extends \Exception
{

	public function __construct(\Exception $e)
	{
		parent::__construct($e->getMessage(), $e->getCode(), $e);
	}

}
