<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Module;
use App\Models\ImagePreset;
use Illuminate\Http\Request;
use App\Traits\ImageGenTrait;

class ModuleController extends Controller
{
    public $path = "upload/module/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [4])->get();
        $this->image_preset_main = ImagePreset::find(10);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::latest()->get();
        return view('backend.module.all_module', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          
        return view('backend.module.add_module');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:countries|max:200',
        ]);
        $image = $request->file('image');
       
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        Module::insert([
            'name' => $request->name,            
            'heading' => $request->heading,
            'link' => $request->link,
            'image' =>  $save_url,
            'small_text' => $request->small_text,
            'text' => $request->text,
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Module Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
       
        return view('backend.module.edit_module', compact('module'));
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        
        } else {
            if ($module->state_image != '') {
                $save_url = $module->image;
            } else {
            }
            $save_url = '';
        }
        $module->update([
            'name' => $request->name,
            'heading' => $request->heading,
            'link' => $request->link,
            'image' =>  $save_url,
            'small_text' => $request->small_text,
            'text' => $request->text,
        ]);
        $notification = array(
            'message' => 'Module Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $img = explode('.', $module->image);
        $small_img = $img[0] . "_thumb." . $img[1];
        if (file_exists($module->image)) {
            unlink($module->image);
        }
        if (file_exists($small_img)) {
            unlink($small_img);
        }
        $module->delete();
        $notification = array(
            'message' => 'Module Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
