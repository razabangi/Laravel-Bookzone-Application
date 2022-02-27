<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use File;

class MediaController extends Controller
{

    public function index()
    {
        $search = request()->get('search');
        $medias = Media::where('title','LIKE','%'.$search.'%')->latest()->paginate(15);
        return view('admin.media.index',compact('medias'));                
    }

    public function create()
    {
        return view('admin.media.add');                
    }


    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required',
            'slug' => 'required',
            'media_img' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        $fileName = null;

        if ($request->hasFile('media_img')) {
            $file = $request->file('media_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/media/',$fileName);
        }

        $data = $request->all();
        $data['media_img'] = $fileName;
        $data['status'] = 'DEACTIVE';

        Media::create($data);
        return redirect()->to('/admin/media');
    }


    public function show($id)
    {
        //
    }

    public function status(Request $request,$id)
    {
        if ($request->ajax()) {
            $media = Media::find($id);
            $currentStatus = $media->status;
            $updatedStatus = ($currentStatus == 'ACTIVE') ? 'DEACTIVE' : 'ACTIVE';
            $media->update([
                'status' => $updatedStatus
            ]);

            return $updatedStatus;   
        }        
    }


    public function edit($id)
    {
        $media = Media::find($id);
        return view('admin.media.edit',compact('media'));                       
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'title' => 'required',
            'slug' => 'required',
        ]);

        $fileName = null;

        if ($request->hasFile('media_img')) {
            $file = $request->file('media_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/media/',$fileName);
        }

         $media = Media::find($id);
         $currentImage = $media->media_img;

         $data = $request->all();
         $data['media_img'] = ($fileName) ? $fileName : $currentImage;

         $media->update($data);
         if ($fileName) {
            File::delete('./uploads/media/'.$currentImage);
         }

         return redirect()->to('/admin/media');
    }


    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            $media = Media::find($id);
            $currentImage = $media->media_img;
            $media->delete();
            File::delete('./uploads/media/'.$currentImage);
            return 'deleted';
        }
    }
}
