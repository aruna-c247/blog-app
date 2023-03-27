<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // pagination
        $perPage = ($request->per_page) ? $request->per_page : 4;
    
        //$blogsData = Blog::with('category')->paginate($perPage); //->orderBy('id', 'desc')->
        
        //get all categories
        $categoryData = Category::all();
        
        // get latest 3 records
        $latestBlog = Blog::latest()->take(3)->get();

        /**************Added search filter code**********************/
        $search = ($request->search) ? $request->search : '';

        
        if  (!empty($search)) {
            $blogsData = DB::table('blogs');

            $blogsData = $blogsData->orWhere('blogs.title', 'like', "%$search%");
            $blogsData = $blogsData->orWhere('blogs.slug', 'like', "%$search%");
            $blogsData = $blogsData->orWhere('categories.slug', 'like', "%$search%");

            $blogsData = $blogsData
                ->select('blogs.*', 'categories.slug as categorySlug', 'categories.category_name')
                ->leftJoin('categories', 'categories.id', 'blogs.id')
                ->paginate($perPage);

           
        } else {
            $blogsData = Blog::with('category')->paginate($perPage);
        }
        /***********end search filter query here***************/ 

        return view('content.frontend.home', compact('blogsData', 'categoryData', 'latestBlog'));
    }

    /**
     * Show the specific data of a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogDetail(Request $request)
    {
        $slug = $request->blog;
        //get all categories
        $categoryData = Category::all();

        // get specific blog via slug
        $blogDetail = Blog::firstWhere('slug', $slug);

       // dd($blogDetail->user_id);
        $userDetail = [];
        if (!empty($blogDetail)) {
            $userDetail = User::findOrFail($blogDetail->user_id);
        }
        //dd($userDetail);
        // get latest 3 records
        $latestBlog = Blog::latest()->take(3)->get();
        return view('content.frontend.blog-detail-page', compact('blogDetail', 'latestBlog', 'categoryData', 'userDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
