<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\Author;
use App\Country;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $searchTerm = request()->get('search');
        $books = Book::where('title','LIKE','%'.$searchTerm.'%')->latest()->paginate(15);
        return view('admin.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $authors = Author::get();
        $countries = Country::get();
        return view('admin.book.add',compact('categories','authors','countries'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|unique:book',
            'slug' => 'required|unique:book',
            'category_id' => 'required',
            'book_img' => 'required|mimes:jpeg,jpg,png,gif',
            'book_upload' => 'required|mimes:pdf',
        ]);
        
        $fileName = null;

        if ($request->hasFile('book_img')) {
            $file = $request->file('book_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/books/',$fileName);
        }

        $filePDF = null;

        if ($request->hasFile('book_upload')) {
            $file = $request->file('book_upload');
            $filePDF = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/books/books_pdf',$filePDF);
        }

        Book::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'category_id' => request()->get('category_id'),
            'author_id' => request()->get('author_id'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'),
            'publisher' => request()->get('publisher'),
            'country_of_publisher' => request()->get('country_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn_10' => request()->get('isbn_10'),
            'book_img' => $fileName,
            'book_upload' => $filePDF,
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'total_pages' => request()->get('total_pages'),
            'edition_number' => request()->get('edition_number'),
            'recommended' => request()->get('recommended'),
            'status' => "DEACTIVE",
            'description' => request()->get('description')
        ]);

        return redirect()->to('/admin/book');
    }

    // public function duplicate_store(Request $request)
    // {
    //     $this->validate(request(),[
    //         'title' => 'required|unique:book',
    //         'slug' => 'required|unique:book',
    //         'category_id' => 'required',
    //     ]);

    //     $book = Book::find(request()->get('id'));
    //     $book_currentImage = $book->book_img;
    //     $book_currentPDF = $book->book_upload;
        
    //     $fileName = null;

    //     if ($request->hasFile('book_img')) {
    //         $file = $request->file('book_img');
    //         $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
    //         $file->move('./uploads/books/',$fileName);
    //     }

    //     $filePDF = null;

    //     if ($request->hasFile('book_upload')) {
    //         $file = $request->file('book_upload');
    //         $filePDF = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
    //         $file->move('./uploads/books/books_pdf',$filePDF);
    //     }

    //     Book::create([
    //         'title' => request()->get('title'),
    //         'slug' => request()->get('slug'),
    //         'category_id' => request()->get('category_id'),
    //         'author_id' => request()->get('author_id'),
    //         'availability' => request()->get('availability'),
    //         'price' => request()->get('price'),
    //         'publisher' => request()->get('publisher'),
    //         'country_of_publisher' => request()->get('country_of_publisher'),
    //         'isbn' => request()->get('isbn'),
    //         'isbn_10' => request()->get('isbn_10'),
    //         'book_img' => ($fileName) ? $fileName : $book_currentImage,
    //         'book_upload' => ($filePDF) ? $filePDF : $book_currentPDF,
    //         'audience' => request()->get('audience'),
    //         'format' => request()->get('format'),
    //         'language' => request()->get('language'),
    //         'total_pages' => request()->get('total_pages'),
    //         'edition_number' => request()->get('edition_number'),
    //         'recommended' => request()->get('recommended'),
    //         'status' => "DEACTIVE",
    //         'description' => request()->get('description')
    //     ]);

    //     return redirect()->to('/admin/book');
    // }

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

    public function status(Request $request,$id)
    {
        if (request()->ajax()) {
            $book = Book::find($id);
            $currentStatus = $book->status;
            $updatedStatus = ($currentStatus == 'ACTIVE') ? 'DEACTIVE' : 'ACTIVE';
            $book->update([
                'status' => $updatedStatus
            ]);
            return $updatedStatus;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $authors = Author::get();
        $countries = Country::get();
        $book = Book::find($id);
        return view('admin.book.edit',compact('book','categories','authors','countries'));        
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
        $this->validate(request(),[
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        $book = Book::find($id);
        $data = $request->all();
        $old_book_img = $book->book_img;
        $old_book_upload = $book->book_upload;
        
        $fileName = null;

        if ($request->hasFile('book_img')) {
            $file = $request->file('book_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/books/',$fileName);
        }

        $filePDF = null;

        if ($request->hasFile('book_upload')) {
            $file = $request->file('book_upload');
            $filePDF = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/books/books_pdf',$filePDF);
        }

        $data['book_img'] = ($fileName) ? $fileName : $old_book_img;
        $data['book_upload'] = ($filePDF) ? $filePDF : $old_book_upload;
        $book->update($data);

        if ($fileName) {
            File::delete('./uploads/books/'.$old_book_img);
        }

        if ($filePDF) {
            File::delete('./uploads/books/books_pdf/'.$old_book_upload);
        }

        return redirect()->to('/admin/book');
    }

    public function duplicate($id)
    {
        $categories = Category::get();
        $authors = Author::get();
        $countries = Country::get();
        $book = Book::find($id);
        return view('admin.book.clone',compact('book','categories','authors','countries'));
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
            $book = Book::find($id);
            $currentImage = $book->book_img;
            $book->delete();
            File::delete('./uploads/books/'.$currentImage);
            return 'deleted';
        }        
    }
}
