<?php

namespace SlevomatEET\Driver;

interface SoapClientDriver
{

	public function send($request, $location, $action, $soapVersion);

}
