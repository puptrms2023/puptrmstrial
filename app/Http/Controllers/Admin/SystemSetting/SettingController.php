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
        $setting_logo = $setting->logo;
        if ($request->hasfile('logo')) {
            unlink(public_path('admin/img/' . $setting_logo));

            $logo = $request->file('logo');
            $logo_ext = $logo->getClientOriginalExtension();
            $logo_name = rand(123456, 999999) . '.' . $logo_ext;
            $logo_path = public_path('admin/img/');
            $logo->move($logo_path, $logo_name);
            $setting->logo = $logo_name;
        } else {
            $setting->logo = $request->old_logo;
        }
        //icon
        $setting_icon = $setting->icon;
        if ($request->hasfile('icon')) {
            unlink(public_path('admin/img/' . $setting_icon));

            $icon = $request->file('icon');
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = rand(123456, 999999) . '.' . $icon_ext;
            $icon_path = public_path('admin/img/');
            $icon->move($icon_path, $icon_name);
            $setting->icon = $icon_name;
        } else {
            $setting->icon = $request->old_icon;
        }

        $setting->save();
        return redirect()->back()->with('success', 'System updated successfully');
    }
}
