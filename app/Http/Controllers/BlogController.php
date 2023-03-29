<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use File;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:blog-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // pagination
        $perPage = ($request->per_page) ? $request->per_page : 5;
       
        $blogData = Blog::with('category')->orderBy('id', 'desc')->paginate($perPage);
    
        return view('content.blogs.blog-list', compact('blogData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryData = Category::all();
       
        return view('content.blogs.create-blog-page', compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogStoreRequest $request, Blog $blog)
    {
        $blogData['title'] = $request->title;
        $blogData['category_id'] = $request->category;
        $blogData['status'] = $request->status;
        $blogData['user_id'] = Auth::id(); 
      
        $blogData['description'] = $request->description ? $request->description : null;
        $blogData['slug'] = $request->slug;
        
        // add feature image 
        if ($request->hasFile('feature_image')) {
           
            $imgName = $request->file('feature_image')->getClientOriginalName();
                
            $imageEncodeName = rand().'_'.time().'_'.$imgName;
            $request->feature_image->move(public_path('images/blog_feature_images'), $imageEncodeName);

            $blogData['feature_image'] = $imageEncodeName;
              
        }
        // save blog data
        $blog->create($blogData);

       return redirect('blog-list')->with('success', 'Blog created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // get all categories
        $categoryData = Category::all();

        // get specific blog via slug
        $blogData = Blog::firstWhere('slug', $slug);
        
        return view('content.blogs.edit-blog-page', compact('categoryData', 'blogData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $slug)
    {
        $blogData['title'] = $request->title;
        $blogData['category_id'] = $request->category;
        $blogData['status'] = $request->status;
        $blogData['user_id'] = Auth::id(); 
        $blogData['description'] = $request->description ? $request->description : null;

        // update feature image 
        if ($request->hasFile('feature_image')) {
           
            $imgName = $request->file('feature_image')->getClientOriginalName();
                
            $imageEncodeName = rand().'_'.time().'_'.$imgName;
            $request->feature_image->move(public_path('images/blog_feature_images'), $imageEncodeName);

            $blogData['feature_image'] = $imageEncodeName;
              
        }
        Blog::where('slug', $slug)->update($blogData);
        return redirect('blog-list')->with('success', 'Blog updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) //$slug
    {
        $blogData = Blog::where('slug', $request->delete_blog_id)->delete();

        return redirect('blog-list')->with('success', 'Blog deleted successfully!');
    }
}
