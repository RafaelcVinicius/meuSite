<?php

namespace App\Repositories\Contracts;

interface BcbSgsRepositoryInterface
{
    public function showApiBcbSgs($code, $format = null);
}
