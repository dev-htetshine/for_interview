<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\CsvUploadRequest;
use App\Services\Domain\PostStoreApplication;
use App\Services\Domain\PostListApplication;
use App\Services\Domain\PostUpdateApplication;
use App\Services\Domain\PostViewApplication;
use App\Services\Domain\PostDeleteApplication;
use App\Services\Domain\Exception\NotFoundException;
use App\Models\Dto\Request\Post\PostStoreRequestDto;
use App\Models\Dto\Request\Post\PostUpdateRequestDto;
use App\Models\Dto\Request\Post\PostDeleteRequestDto;
use Carbon\Carbon;
use Storage;
use App\Repositories\Post\PostRepository;

class Postcontroller extends Controller
{
    private PostStoreApplication $postStoreApplication;

    private PostListApplication $postListApplication;

    private PostUpdateApplication $postUpdateApplication;

    private PostViewApplication $postViewApplication;

    private PostDeleteApplication $postDeleteApplication;

    private PostRepository $postRepository;

    public function __construct(
        PostStoreApplication $postStoreApplication,
        PostListApplication $postListApplication,
        PostUpdateApplication $postUpdateApplication,
        PostViewApplication $postViewApplication,
        PostDeleteApplication $postDeleteApplication,
        PostRepository $postRepository
    ) {
        $this->postStoreApplication = $postStoreApplication;
        $this->postListApplication = $postListApplication;
        $this->postUpdateApplication = $postUpdateApplication;
        $this->postViewApplication = $postViewApplication;
        $this->postDeleteApplication = $postDeleteApplication;
        $this->postRepository = $postRepository;
    }

    public function store(PostRequest $request)
    {
        $request->created_user_id = \Auth::id();
        $request->createdAt = Carbon::now()->format('Y-m-d H:i:s');

        $postDto = new PostStoreRequestDto(
            $request->title,
            $request->comment,
            $request->created_user_id,
            $request->createdAt
        );

        return $this->postStoreApplication->handle($postDto)->toResponse();
    }

    public function list()
    {
        $currentLogInUser = \Auth::user();
        return $this->postListApplication->handle($currentLogInUser);
    }

    public function update(PostUpdateRequest $request, $postId)
    {
        $request->updated_user_id = \Auth::id();
        $request->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $request->post_id = $postId;

        $PostDto = new PostUpdateRequestDto(
            $request->post_id,
            $request->title,
            $request->comment,
            $request->status,
            $request->updated_user_id,
            $request->updated_at
        );

        return $this->postUpdateApplication->handle($PostDto)->toResponse();
    }

    public function view($postId)
    {
        return $this->postViewApplication->handle($postId)->toResponse();
    }

    public function destroy($postId)
    {
        $deletedUserId =  \Auth::id();
        $deletedAt =  Carbon::now()->format('Y-m-d H:i:s');
        
        $postDto =  new PostDeleteRequestDto(
            $postId,
            $deletedUserId,
            $deletedAt
        );

        return $this->postDeleteApplication->handle($postDto)->toResponse();
    }

    public function upload(CsvUploadRequest $request)
    {
        $createdUserId = \Auth::id();
        $createdAt = Carbon::now()->format('Y-m-d H:i:s');
        
        if($file = $request->file('csv_file')) {
            $systemDate = Carbon::now()->format('YmdHis');
            $path = Storage::disk('local')->path('/upload/csv');
            $fileName = '_'.$file->getClientOriginalName();

            $csv = $request->file('csv_file')->getRealPath();
            $posts = array_map('str_getcsv', file($csv));

            $data = $this->postRepository->getTitle();  
            $existsTitle  = json_decode(json_encode($data), true);

            foreach ($posts as $post) {
                $title = $post[0];
                $newTitle = array("title"=>$title);
                $comment = $post[1];

                if(in_array($newTitle, $existsTitle)){
                    $postEntity['message'] = 'Title is already taken. You can not upload your csv file.';
                    return json_encode($postEntity);
                }else{
                    $postDto = new PostStoreRequestDto(
                        $title,
                        $comment,
                        $createdUserId,
                        $createdAt
                    );

                    $this->postStoreApplication->handle($postDto);
                }
            }

            if($file->move($path, $systemDate.$fileName)) { 
                $postEntity['message'] = 'Your Csv file is uploaded successfully';
                return json_encode($postEntity);
            }
        }
    }
}
