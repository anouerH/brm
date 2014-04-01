<?php

namespace Star\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StarUserBundle extends Bundle
{
	public function getParent()
  	{
    	return 'FOSUserBundle';
  	}
}
