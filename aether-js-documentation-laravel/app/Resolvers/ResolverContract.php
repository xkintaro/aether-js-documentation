<?php

namespace App\Resolvers;

use Closure;
use Symfony\Component\HttpFoundation\Response;

interface ResolverContract
{
    public function handle(array $payload, Closure $next);
}
