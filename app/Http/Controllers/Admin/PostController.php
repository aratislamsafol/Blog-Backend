<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    public function getall()
    {
        $post = Post::orderBy('id','DESC')->latest()->get();

        return datatables($post)

          ->addColumn('created_at', function ($post) {
              if($post->created_at==null){
                  return 'this is null';
              }else{
                return $post->created_at->diffForHumans();
              }
          })
          ->addColumn('updated_at', function ($post) {
            if($post->updated_at==null){
                return 'this is null';
            }else{
              return $post->updated_at->diffForHumans();
            }
        })

          ->addColumn('post_img', function ($post) {
              $url= asset($post->post_img);
             return '<img src="'.$url.'" frameborder="0" width="100%" height="80px">';
         })
          ->addColumn('action', 'admin.post.action')
          ->rawColumns(['post_img','action'])
          ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = View::make('admin.post.create')->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_img'=> 'required|mimes:jpeg,png,jpg',
        ]);

        $post = new Post;

        $post->post_title=$request->post_title;
        $post->post_details=$request->post_details;
        $post->user_id=Auth::user()->id;

        $postimage = $request->file('post_img');
        $name_gen =rand(100000,999999). ".".$postimage->getClientOriginalExtension();
        image::make($postimage)->resize(1024, 576 )->save( public_path('/uploads/post/' . $name_gen));
        $notcepath = ('/uploads/post') . '/' .$name_gen;
        $post->post_img = $notcepath;

        $post->save();
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tougallery =Post::find($id);
        $view = View::make('admin.post.view', compact('tougallery'))->render();

        return response()->json(['html' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts =Post::find($id);
        $view = View::make('admin.post.edit', compact('posts'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post =Post::find($id);
        $this->validate($request, [
            'post_img'=> 'mimes:jpeg,png,jpg',
        ]);
        $post->post_title=$request->post_title;
        $post->post_details=$request->post_details;

        if($request->file('post_img')!=null){
            unlink(public_path($post->post_img));
            $tourimage = $request->file('post_img');
            $name_gen =rand(100000,999999). ".".$tourimage->getClientOriginalExtension();
            $path = public_path('/uploads/post/'.$name_gen);
            Image::make($tourimage)->resize(1024, 576 )->save($path);
            $notcepath = '/uploads/post/' .$name_gen;
            $post->post_img = $notcepath;
        }

        $post->save();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::find($id);
        unlink(public_path($post->post_img));
        $post->delete();
        return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
    }
}
