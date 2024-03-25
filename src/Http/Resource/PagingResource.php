<?php

declare(strict_types=1);

namespace App\Http\Resource;

use JsonSerializable;
use Nette\Utils\Paginator;

class PagingResource implements JsonSerializable
{
    public function __construct(private readonly Paginator $paginator)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'page' => $this->paginator->page,
            'from' => $this->paginator->firstPage,
            'to' => $this->paginator->lastPage,
            'total' => $this->paginator->itemCount,
        ];
    }
}
