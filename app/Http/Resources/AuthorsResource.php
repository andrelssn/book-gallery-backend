<?php

namespace App\Http\Resources;

use App\Services\Api\Books\BooksService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        $booksService = app(BooksService::class);

        $getBook = $booksService->getBooksByAuthor($this->id);

        $bookInfo = [];

        if ($getBook) {
            foreach ($getBook as $book) {
                $bookInfo[] = $booksService->getBook($book['book_id']);
            }
        }

        return [
            "Id"        => $this->id,
            "Name"      => $this->name,
            "Pseudonym" => $this->pseudonym,
            "Birth"     => $this->birth ? Carbon::parse($this->birth)->format('d/m/Y') : null,
            "Death"     => $this->death ? Carbon::parse($this->death)->format('d/m/Y') : null,
            "Books"     => $bookInfo
        ];
    }
}
