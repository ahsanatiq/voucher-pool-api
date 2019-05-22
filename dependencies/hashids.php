<?php

use Hashids\Hashids;

return new Hashids($container['settings']['hashids']['key'], $container['settings']['hashids']['code_length']);
