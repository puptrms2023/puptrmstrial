<?php

namespace App\Http\Controllers\Admin\SystemSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdate;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.manage-settings.index', compact('setting'));
    }

    public function update(SettingUpdate $request, $id)
    {
        $validatedData = $request->validated();
        $setting = new Setting;
        $setting = Setting::find($id);
        $setting->session_year = $validatedData['session_year'];
        $setting->system_title = $validatedData['system_title'];
        $setting->system_name = $validatedData['system_name'];
        $setting->phone = $validatedData['phone'];
        $setting->address = $validatedData['address'];
        $setting->email = $validatedData['email'];

        //logo

        $old_logo = $request->old_logo;
        if ($request->hasfile('logo')) {

            $logo_path = public_path('admin/img/');
            if (file_exists($logo_path . $old_logo)) {
                @unlink($logo_path . $old_logo);
            }
            $logo = $request->file('logo');
            $logo_ext = $logo->getClientOriginalExtension();
            $logo_name = rand(123456, 999999) . '.' . $logo_ext;
            $logo->move($logo_path, $logo_name);
            $final_logo = $logo_name;
        } else {
            $final_logo = $old_logo;
        }
        //icon
        $old_icon = $request->old_icon;
        if ($request->hasfile('icon')) {

            $icon_path = public_path('admin/img/');
            if (file_exists($icon_path . $old_icon)) {
                @unlink($icon_path . $old_icon);
            }

            $icon = $request->file('icon');
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = rand(123456, 999999) . '.' . $icon_ext;
            $icon->move($icon_path, $icon_name);
            $final_icon = $icon_name;
        } else {
            $final_icon = $old_icon;
        }

        $setting->logo = $final_logo;
        $setting->icon = $final_icon;
        $setting->save();
        return redirect()->back()->with('success', 'System updated successfully');
    }
}
