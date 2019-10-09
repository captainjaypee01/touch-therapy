<?php

namespace App\Http\Controllers\Backend\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Record\Package;
use App\Models\Record\Service;

class PackageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $packages = Package::orderBy("created_at", "desc"); 
        $append = array();
        if($keyword = request("search")){
            $append["search"] = $keyword;
            $packages = $packages->where("name", "like", "%". $keyword . "%");
        }

        $packages = $packages->paginate(10)->setpath('');
        $packages->appends($append); 
        return view('backend.record.package.index',
            [ 
                "search" => $keyword,
                "packages" => $packages, 
            ]); 
    }

    public function create(){ 
        $services = Service::where('status', 1)->orderBy("category", 'asc')->get();
        return view('backend.record.Package.create',
            [ 
                "services" => $services,
            ]);
    }

    public function show(Package $package){ 
        return view('backend.record.package.show',
            [ 
                "package" => $package,  
            ]);
    }

    public function edit(Package $package){ 
        $services = Service::where('status', 1)->orderBy("category", 'asc')->get();
        return view('backend.record.package.edit',
            [ 
                "package" => $package,  
                "services" => $services,
            ])
            ->withPackageServices($package->services->all());
    }

    public function store(Request $request){
        $package = new Package();
        return $this->save($request, $package);
    }

    public function update(Request $request, Package $package){
        return $this->save($request, $package);
    }
    public function destroy(Package $package){ 
        $package->delete();
        return redirect()->route('admin.record.package.index')->withFlashSuccess("Package Successfully Deleted");
    }

    public function save($form, $package){
        // Validate
        request()->validate([
            'name' => 'required', 
            'price' => 'required', 
            'services' => 'required',
            'duration' => 'required|numeric|min:15',
        ]); 
        if(isset($form['name']))
            $package->name = $form["name"];
 
        if(isset($form['description']))
            $package->description = $form["description"];

        if(isset($form['price']))
            $package->price = $form["price"] > 0 ? $form["price"] : null;
  
        if(isset($form['duration']))
            $package->duration = $form["duration"];

        $package->save();
        
        if(isset($form['services']))
            $package->services()->sync($form['services']);// = $form["unit"];
        
        return redirect()->route('admin.record.package.index')->withFlashSuccess("Package Successfully Saved");

    }

    public function remove_branch(Request $request){
        
    }
    public function mark(Package $package, $status){
        $package->status = $status;
        $package->save();
        return redirect()->route('admin.record.package.index')->withFlashSuccess("Package Status Saved");
    }

    public function getProvinces(){
        return DB::select("select * from provinces where status = 1");
    }

}
