<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use File;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::latest()->paginate(15);
        return view('admin.team.index',compact('teams'));                        
    }

    public function create()
    {
        return view('admin.team.add');                        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'fullname' => 'required',
            'email' => 'required|unique:team',
            'team_img' => 'required|mimes:jpg,jpeg,png,gif',            
        ]);

        $fileName = null;
        if (request()->hasFile('team_img')) {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/team',$fileName);
        }

        $data = $request->all();
        $data['status'] = 'DEACTIVE';
        $data['team_img'] = $fileName;
        Team::create($data);
        return redirect()->to('/admin/team');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.team.edit',compact('team'));                                
    }

    public function status(Request $request, $id)
    {
        if ($request->ajax()) {
           $team = Team::find($id);
           $currentStatus = $team->status;
           $updatedStatus = ($currentStatus == 'ACTIVE') ? 'DEACTIVE' : 'ACTIVE';
           $team->update([
            'status' => $updatedStatus
           ]);

           return $updatedStatus;
        }
    }

    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        $currentImage = $team->team_img;

        $this->validate(request(),[
            'fullname' => 'required',
            'slug' => 'required',
            // 'team_img' => 'image|mimes:jpg,jpeg,png,gif'  
        ]);

        $fileName = null;

        if (request()->hasFile('team_img')) {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
            $file->move('./uploads/team/',$fileName);
        }

        $data = $request->all();

        $data['team_img'] = ($fileName) ? $fileName : $currentImage;
        $team->update($data);

         if ($fileName)
            File::delete('./uploads/team/'.$currentImage);
        
        return redirect()->to('/admin/team');
    }

    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            $team = Team::find($id);
            $currentImage = $team->team_img;
            $team->delete();
            File::delete('./uploads/team/'.$currentImage);
            return 'deleted';
        }
        
    }
}
