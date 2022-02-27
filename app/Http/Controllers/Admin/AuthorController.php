<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\Country;
use File; 

class AuthorController extends Controller
{

    public function index()
    {
        $searchTerm = request()->get('search');
        $authors = Author::where('title','LIKE','%'.$searchTerm.'%')->latest()->paginate(15);
        return view('admin.author.index',compact('authors'));
    }

    public function create()
    {
        $countries = Country::get();
        return view('admin.author.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required',
            'author_img' => 'required|mimes:jpg,jpeg,png,gif',            
        ]);

        $fileName = null;
        if (request()->hasFile('author_img')) {
            $file = request()->file('author_img');
            $fileName = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/author',$fileName);
        }

        $data = $request->all();
        $data['status'] = 'DEACTIVE';
        $data['author_img'] = $fileName;
        Author::create($data);
        return redirect()->to('admin.author');
    }

    public function status(Request $request, $id)
    {
        if ($request->ajax()) {
            $author = Author::find($id);
            $currentStatus = $author->status;
            $updateStatus = ($currentStatus == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $author->update([
                'status' => $updateStatus
            ]);
            return $updateStatus;
        }       
    }

    // public function duplicate($id)
    // {
    //     $author = Author::find($id);
    //     return view('admin.author.clone',compact('author'));
    // }

    // public function duplicate_store(Request $request)
    // {
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'slug' => 'required',
    //         'author_img' => 'required|mimes:jpg,jpeg,png,gif',            
    //     ]);

    //     $fileName = null;
    //     if (request()->hasFile('author_img')) {
    //         $file = request()->file('author_img');
    //         $fileName = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
    //         $file->move('./uploads/author',$fileName);
    //     }

    //     $data = $request->all();
    //     $data['status'] = 'DEACTIVE';
    //     $data['author_img'] = $fileName;
    //     Author::create($data);
    //     return redirect()->to('admin.author');
    // }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $author = Author::find($id);
        $countries = Country::get();
        return view('admin.author.edit',compact('author','countries'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        $currentImage = $author->author_img;

        $this->validate(request(),[
            'title' => 'required',
            'slug' => 'required',
            // 'author_img' => 'image|mimes:jpg,jpeg,png,gif'  
        ]);

        $fileName = null;

        if (request()->hasFile('author_img')) {
            $file = request()->file('author_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/author/',$fileName);
        }

        $data = $request->all();

        $data['author_img'] = ($fileName) ? $fileName : $currentImage;
        $author->update($data);

         if ($fileName)
            File::delete('./uploads/author/'.$currentImage);
        
        return redirect()->to('/admin/author');
    }

    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            $author = Author::find($id);
            $currentImage = $author->author_img;
            File::delete('./uploads/author/'.$currentImage);
            $author->delete();
            return 'deleted';
        }
    }
}
