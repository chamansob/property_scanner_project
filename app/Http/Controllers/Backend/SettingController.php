<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;
use App\Models\SiteSetting;
use App\Models\ImagePreset;
use App\Traits\ImageGenTrait;

class SettingController extends Controller
{
    //
    public $path = "upload/template/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [1])->get();
        $this->image_preset_main = ImagePreset::find(13);
    }
    public function SmtpSetting()
    {
        $setting = SmtpSetting::find(1);
        return view('backend.setting.smpt_update', compact('setting'));
    } // End Method 
    public function UpdateSmtpSetting(Request $request, $id)
    {
        SmtpSetting::findOrFail($id)->update([

            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_name' => $request->from_name,
            'from_address' => $request->from_address,
        ]);


        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
    public function SiteSetting()
    {

        $sitesetting = SiteSetting::find(1);
        return view('backend.setting.site_update', compact('sitesetting'));
    } // End Method 
    public function UpdateSiteSetting(Request $request, $id)
    {
       
        $site_id = $id;

        $validated = $request->validate([
            'site_title' => 'required',
            'support_phone' => 'required',
            'company_address' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'copyright' => 'required'
        ]);
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image = $request->file('logo');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);


            SiteSetting::findOrFail($site_id)->update([
                'site_title' => $request->site_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'app_name' => $request->app_name,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'pinterest' => $request->pinterest,
                'google' => $request->google,
                'vimeo' => $request->vimeo,
                'copyright' => $request->copyright,
                'discount' => $request->discount,
                'currency' => $request->currency,
                'logo' => $save_url,
            ]);

            $notification = array(
                'message' => 'SiteSetting Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($site_id)->update([
                'site_title' => $request->site_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'app_name' => $request->app_name,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'pinterest' => $request->pinterest,
                'google' => $request->google,
                'vimeo' => $request->vimeo,
                'copyright' => $request->copyright,
                'discount' => $request->discount, 
                'currency' => $request->currency,
            ]);

            $notification = array(
                'message' => 'SiteSetting Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method 
}
