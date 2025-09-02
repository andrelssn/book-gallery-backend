<?php

namespace App\Http\Resources;

use App\Services\Api\Books\BooksService;
use App\Services\Api\Authors\AuthorsService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        $booksService = app(BooksService::class);
        $authorService = app(AuthorsService::class);


        $getAuthor = $booksService->getAuthorId($this->id);

        $getAuthorInfo = null;
        if ($getAuthor) {
            $getAuthorInfo = $authorService->getAuthorInfo($getAuthor->author_id);
        }

        return [
            "Id"        => $this->id,
            "Title"     => $this->title,
            "Subtitle"  => $this->subtitle,
            "Year"      => $this->year,
            "Edition"   => $this->edition,
            "Author"    => $getAuthorInfo
        ];
    }
}
