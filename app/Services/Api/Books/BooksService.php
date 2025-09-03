<?php

namespace App\Services\Api\Books;

use App\Models\Books;
use App\Models\Books_authors;
use App\Repositories\Books\BooksRepository;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class BooksService
{
    private $booksRepository;
    private $userInfoRepository;

    public function __construct(BooksRepository $booksRepository, UserInfoRepository $userInfoRepository)
    {
        $this->booksRepository   = $booksRepository;
        $this->userInfoRepository = $userInfoRepository;
    }

    public function storeBook(Request $request)
    {
        $post = Books::create([
            'title'    => $request->title,
            'subtitle' => $request->subtitle,
            'year'     => $request->year,
            'edition'  => $request->edition,
        ]);

        $bookId = $post->id;

        if ($request->author !== null) {
            Books_authors::create([
                'book_id' => $bookId,
                'author_id' => $request->author
            ]);
        }

        return $post;
    }

    public function updateBook(Request $request, int $id): bool
    {
        $data = $this->booksRepository->getWhere($id);

        if (!$data) {
            throw new HttpResponseException(response()->json([
                'error' => 'Book not found'
            ], 422));
        }

        $bookId = $data->id;

        $authorUpdated = false;
        $bookUpdated   = false;

        if ($request->author !== null) {
            $authorUpdated = Books_authors::updateOrCreate(
                ['book_id' => $bookId],
                ['author_id' => $request->author]
            ) ? true : false;
        }

        $bookUpdated = Books::where('id', $bookId)->update([
            'title'    => $request->title,
            'subtitle' => $request->subtitle,
            'year'     => $request->year,
            'edition'  => $request->edition,
        ]) > 0;

        if ($authorUpdated || $bookUpdated) {
            return true;
        }
    }

    public function deleteBook(int $id): bool
    {
        Books_authors::where('book_id', $id)->delete();

        $delete = Books::where('id', $id)->delete();

        if (!isset($delete)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Book not found'
            ], 422));
        };

        return $delete;
    }

    public function getAuthorId(int $id)
    {
        $get = Books_authors::where('book_id', $id)->first();

        if (!$get) {
            return null;
        }

        return $get;
    }

    public function getBooksByAuthor(int $id)
    {
        $get = Books_authors::where('author_id', $id)->get()->toArray();

        if (!$get) {
            return null;
        }

        return $get;
    }

    public function getBook(int $id)
    {
        $get = Books::where('id', $id)->first();

        if (!$get) {
            return null;
        }

        return $get;
    }

}
