<?php

namespace Star\MessageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StarMessageBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSMessageBundle';
    }
}
