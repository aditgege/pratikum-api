<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;

class SiteController extends Controller
{
    //
    const API_BASE = 'https://blog-api.stmik-amikbandung.ac.id/api/v2/blog/_table/';
    const API_KEY ='ef9187e17dce5e8a5da6a5d16ba760b75cadd53d19601a16713e5b7c4f683e1b';

    private $apiClient;

    public function __construct() {
        $this->apiClient = new Client([
            'base_uri' => self::API_BASE,
            'headers' => [
                'X-DreamFactory-API-Key' => self::API_KEY
                ]
            ]);

    }

    public function index()
    {
        $data = Cache::get('index', function () {
            try {
                $reqData = $this->apiClient->get('articles');
                $resource = json_decode($reqData->getBody())->resource;
                $reqDatas = [];
                foreach($resource as $data){
                    $author = $this->apiClient->get("authors/{$data->author}");
                    $resourceAuthor = json_decode($author->getBody());
                    $reqDatas[] = [
                        "id" => $data->id,
                        "title" => $data->title,
                        "author_id" => $data->author,
                        "author_name" => $resourceAuthor->name,
                        "content" => $data->content,
                        "published_at" => $data->published_at,
                        "created_at" => $data->created_at
                    ];
                }
                Cache::add('index', json_decode(json_encode((object) $reqDatas), FALSE));
                return json_decode(json_encode((object) $reqDatas), FALSE);

            } catch (RequestException $e) {
                return [];
            }
        });
        // dd($data);
        return view('index', ['data' => $data]);
    }

    public function getArticles($id) {
        $key = "articles/{$id}";
        $data = Cache::get($key, function() use ($key) {
            try {
                $reqData = $this->apiClient->get($key);
                $resource = json_decode($reqData->getBody());
                Cache::add($key, $resource);
                return $resource;
            } catch (Exception $e) {
                return redirect()->back()->with('failed', 'Something went wrong');
            }
        });
        $user = User::find($data->author);
        $data->author_name = $user->name ?? "-";
        return view('viewArticle', [
            'data' => $data,
            'comments' => Comment::where('article_id', $id)->get(),
            'total_comment' => Comment::where('article_id', $id)->count()
        ]);
    }

    public function newArticles(Request $request) {
        if($request->isMethod('post')) {
            $title = $request->input('frm-title');
            $content = $request->input('frm-content');
            $published_at = null;
            if ($request->input('frm-status') == 'published') {
                $published_at = Carbon::now();
            }
            $dataModel['resource'][] = [
                'author' => Auth::user()->id,
                'title' => $title,
                'content' => $content,
                'published_at' => $published_at,
            ];

            try {
                $reqData = $this->apiClient->post('articles', [
                    'json' => $dataModel
                ]);

                // $apiResponse = json_decode($reqData->getBody())->resource;
                // $newId = $apiResponse[0]->id;
                // dd($newId);

                Cache::forget('index');
                return redirect("/articles")->with('success', 'Article has been created');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'Add Article Failed');
            }
        }
        
        return view('newArticle');
    }

    public function editArticles(Request $request, $id) {
        if($request->isMethod('put')) {
            $title = $request->input('frm-title');
            $content = $request->input('frm-content');
            $published_at = null;
            if ($request->input('frm-status') == 'published') {
                $published_at = Carbon::now();
            }
            $dataModel['resource'][] = [
                'author' => Auth::user()->id,
                'title' => $title,
                'content' => $content,
                'published_at' => $published_at,
            ];

            try {
                $key = "articles/{$id}";
                $reqData = $this->apiClient->put($key, [
                    'json' => $dataModel
                ]);
                Cache::forget($key);
                Cache::forget('index');
                return redirect()->route('article-show', $id)->with('success', 'Edit Success');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'Edit failed');
            }
        }
        $key = "articles/{$id}";
        $data = Cache::get($key, function() use ($key) {
            try {
                $reqData = $this->apiClient->get($key);
                $resource = json_decode($reqData->getBody());

                Cache::add($key, $resource);
                return $resource;
            } catch (Exception $e) {
                return redirect()->back()->with('failed', 'Something went wrong');
            }
        });
        $user = User::find($data->author);
        $data->author_name = $user->name ?? "-";

        return view('editArticle', ['data' => $data]);
    }

    public function deleteArticles(Request $request, $id) {
        try {
            $key = "articles/{$id}";
            $reqData = $this->apiClient->delete($key);
            $resource = json_decode($reqData->getBody());
            Cache::forget($key);
            Cache::forget('index');
            // return redirect("/articles")->with('success', 'Delete Success');
            return redirect()->route('article-index')->with('success', 'Suskes bang');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Delete failed');
        }    
    }

    public function commentArticles(Request $request) {
        try {
            $comment = new Comment();
            $comment->article_id = $request->input('form-article-id');
            $comment->name = $request->input('form-name');
            $comment->content = $request->input('form-content');
            $comment->save();

            return redirect()->route('article-show', $request->input('form-article-id'));
        } catch (\Exception $ex) {
            return redirect()->back()->with('failed', 'Add Comment Failed');
        }
        return redirect()->back();
    }
}