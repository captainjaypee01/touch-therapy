<?php

namespace App\Http\Controllers\Backend\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Record\Branch;
use App\Models\Record\Service;
use App\Models\Record\BranchService;
use Log;

class ServiceController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::orderBy("created_at", "desc"); 
        $append = array();
        if($keyword = request("search")){
            $append["search"] = $keyword;
            $services = $services->where("name", "like", "%". $keyword . "%");
        }

        $services = $services->paginate(10)->setpath('');
        $services->appends($append); 
        return view('backend.record.service.index',
            [ 
                "search" => $keyword,
                "services" => $services, 
            ]); 
    }

    public function create(){ 
        return view('backend.record.service.create',
            [ 
            ]);
    }

    public function show(Service $service){ 
        return view('backend.record.service.show',
            [ 
                "service" => $service,  
            ]);
    }

    public function edit(Service $service){ 
        return view('backend.record.service.edit',
            [ 
                "service" => $service,  
            ]);
    }

    public function store(Request $request){
        $service = new Service();
        return $this->save($request, $service);
    }

    public function update(Request $request, Service $service){
        return $this->save($request, $service);
    }
    public function destroy(Service $service){ 
        $service->delete();
        return redirect()->route('admin.record.service.index')->withFlashSuccess("Service Successfully Deleted");
    }

    public function save($form, $service){
        // Validate
        request()->validate([
            'name' => 'required', 
            'description' => 'required',
            'duration' => 'required|numeric|min:15',
        ]);
        if(request('category') == 'Body Massage'){
            request()->validate([
                'non_member_price' => 'required', 
                'member_price' => 'required',
            ]);
            if(isset($form['non_member_price']))
                $service->non_member_price = $form["non_member_price"];
                
            if(isset($form['member_price']))
                $service->member_price = $form["member_price"];
        }
        elseif(request('category') == 'Waxing Services'){
            request()->validate([
                'male_price' => 'required', 
                'female_price' => 'required',
            ]);
            if(isset($form['male_price']))
                $service->male_price = $form["male_price"];
                
            if(isset($form['female_price']))
                $service->female_price = $form["female_price"];
        }

        if(isset($form['name']))
            $service->name = $form["name"];

        if(isset($form['description']))
            $service->description = $form["description"];

        if(isset($form['category']))
            $service->category = $form["category"];

        if(isset($form['price']))
            $service->price = $form["price"] > 0 ? $form["price"] : null;

        if(isset($form['duration']))
            $service->duration = $form["duration"];

        if(request()->has('upload_file')){
             // Upload the file and put it to 'uploads' folder
             $file = request()->upload_file;
             $location = $file->store('service');
             $service->filename = $file->getClientOriginalName();
             $service->image_location = $location;
             $service->location = $location;
             $service->type = "service";
             $service->size = $file->getClientSize();
             $service->hash = sha1_file($file->path());
             $service->ip_address = request()->ip();
        }
        
        $service->user_id = auth()->user()->id;

        $service->save();
        
        return redirect()->route('admin.record.service.index')->withFlashSuccess("Service Successfully Saved");

    }

    
    public function mark(Service $service, $status){
        $service->status = $status;
        $service->save();
        return redirect()->route('admin.record.service.index')->withFlashSuccess("Service Status Saved");
    }

    public function getProvinces(){
        return DB::select("select * from provinces where status = 1");
    }

}
