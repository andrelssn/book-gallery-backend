<?php

namespace App\Services\Api\Authors;

use App\Models\Authors;
use App\Models\Books_authors;
use App\Repositories\Authors\AuthorsRepository;
use App\Repositories\UserInfo\UserInfoRepository;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthorsService
{
    private $authorsRepository;
    private $userInfoRepository;

    public function __construct(AuthorsRepository $authorsRepository, UserInfoRepository $userInfoRepository)
    {
        $this->authorsRepository   = $authorsRepository;
        $this->userInfoRepository = $userInfoRepository;
    }

    public function getBooks(Request $request, int $id)
    {
        $get = Books_authors::where('id_author', $id);

        return $get;
    }

    public function storeAuthor(Request $request)
    {
        $birth = $request->birth ? Carbon::createFromFormat('d/m/Y', $request->birth)->format('Y-m-d') : null;
        $death = $request->death ? Carbon::createFromFormat('d/m/Y', $request->death)->format('Y-m-d') : null;

        $post = Authors::create([
            'name'      => $request->name,
            'pseudonym' => $request->pseudonym,
            'birth'     => $birth,
            'death'     => $death,
        ]);

        return $post;
    }

    public function updateAuthor(Request $request, int $id): bool
    {
        $data = $this->authorsRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Author not found'
            ], 422));
        };

        $birth = $request->birth ? Carbon::createFromFormat('d/m/Y', $request->birth)->format('Y-m-d') : null;
        $death = $request->death ? Carbon::createFromFormat('d/m/Y', $request->death)->format('Y-m-d') : null;

        $update = Authors::where('id', $id)->update([
            'name'      => $request->name,
            'pseudonym' => $request->pseudonym,
            'birth'     => $birth,
            'death'     => $death,
        ]);

        return $update;
    }

    public function deleteAuthor(int $id): bool
    {
        $delete = Authors::where('id', $id)->delete();

        if (!isset($delete)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Author not found'
            ], 422));
        };

        return $delete;
    }

    public function getAuthorInfo(int $id)
    {
        $get = Authors::where('id', $id)->first();

        if (!isset($get)) {
            return "Author not found";
        };

        return $get;
    }
}
