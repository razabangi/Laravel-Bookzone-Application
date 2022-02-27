<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request()->get('search');
        $categories = Category::where('title','LIKE','%'.$searchTerm.'%')->paginate(15);
        return view('admin.category.index',compact('categories'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:category',
            'slug' => 'required|unique:category'
        ]);

        $data = $request->all();
        Category::create($data);
        return redirect()->to('admin/category');

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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));                
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
        $this->validate($request,[
            'title'=>'required',
            'slug'=>'required'
        ]);

        $data = $request->all();
        $category = Category::find($id);
        $category->update($data);
        return redirect()->to('/admin/category');
    }

    public function status(Request $request,$id)
    {
        if ($request->ajax()) {
            $category = Category::find($id);
            $currentStatus = $category->status;
            $updatedStatus = ($currentStatus == 'ACTIVE') ? 'DEACTIVE' : 'ACTIVE';
            $data = [ 'status' => $updatedStatus ];
            $category->update($data);
            return $updatedStatus;
        }           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       if ($request->ajax()) {
            $category = Category::find($id);
            $category->delete();
            return 'deleted';
        } 
    }
}
