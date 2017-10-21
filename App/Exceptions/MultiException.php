<?php

namespace App\Exceptions;

use App\Components\TCollection;

class MultiException
    extends \Exception
    implements \ArrayAccess, \Iterator
{
    use TCollection;

}