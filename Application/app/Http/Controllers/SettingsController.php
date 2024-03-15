<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        try{
            $settings = Setting::find($setting);
            return view('admin.settings.settings')->with('settings', $settings);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        try{
            //websiteIcon
            if($request->websiteIcon != NULL){
                $websiteIconName = $setting->websiteIcon;
                if (\File::exists(public_path('/images/settings/websiteIconName'.$websiteIconName))) {
                    unlink(public_path('/images/settings/websiteIconName'.$websiteIconName));
                }
                $image = $request->file('websiteIcon');
                $websiteIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/websiteIconName'.$websiteIconName));
            }else{
                $websiteIconName = $setting->websiteIcon;
            }

            //headerFooterLogo
            if($request->headerFooterLogo != NULL){
                $headerFooterLogoName = $setting->headerFooterLogo;
                if (\File::exists(public_path('/images/settings/headerFooterLogoName'.$headerFooterLogoName))) {
                    unlink(public_path('/images/settings/headerFooterLogoName'.$headerFooterLogoName));
                }
                $image = $request->file('headerFooterLogo');
                $headerFooterLogoName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/headerFooterLogoName'.$headerFooterLogoName));
            }else{
                $headerFooterLogoName = $setting->headerFooterLogo;
            }

            //telephoneIcon
            if($request->telephoneIcon != NULL){
                $telephoneIconName = $setting->telephoneIcon;
                if (\File::exists(public_path('/images/settings/telephoneIconName'.$telephoneIconName))) {
                    unlink(public_path('/images/settings/telephoneIconName'.$telephoneIconName));
                }
                $image = $request->file('telephoneIcon');
                $telephoneIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/telephoneIconName'.$telephoneIconName));
            }else{
                $telephoneIconName = $setting->telephoneIcon;
            }

            //faxIcon
            if($request->faxIcon != NULL){
                $faxIconName = $setting->faxIcon;
                if (\File::exists(public_path('/images/settings/faxIconName'.$faxIconName))) {
                    unlink(public_path('/images/settings/faxIconName'.$faxIconName));
                }
                $image = $request->file('faxIcon');
                $faxIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/faxIconName'.$faxIconName));
            }else{
                $faxIconName = $setting->faxIcon;
            }


            //mobileIcon
            if($request->mobileIcon != NULL){
                $mobileIconName = $setting->mobileIcon;
                if (\File::exists(public_path('/images/settings/mobileIconName'.$mobileIconName))) {
                    unlink(public_path('/images/settings/mobileIconName'.$mobileIconName));
                }
                $image = $request->file('mobileIcon');
                $mobileIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/mobileIconName'.$mobileIconName));
            }else{
                $mobileIconName = $setting->mobileIcon;
            }

            //emailIcon
            if($request->emailIcon != NULL){
                $emailIconName = $setting->emailIcon;
                if (\File::exists(public_path('/images/settings/emailIconName'.$emailIconName))) {
                    unlink(public_path('/images/settings/emailIconName'.$emailIconName));
                }
                $image = $request->file('emailIcon');
                $emailIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/emailIconName'.$emailIconName));
            }else{
                $emailIconName = $setting->emailIcon;
            }

            //facebookIcon
            if($request->facebookIcon != NULL){
                $facebookIconName = $setting->facebookIcon;
                if (\File::exists(public_path('/images/settings/facebookIconName'.$facebookIconName))) {
                    unlink(public_path('/images/settings/facebookIconName'.$facebookIconName));
                }
                $image = $request->file('facebookIcon');
                $facebookIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/facebookIconName'.$facebookIconName));
            }else{
                $facebookIconName = $setting->facebookIcon;
            }

            //whatsappIcon
            if($request->whatsappIcon != NULL){
                $whatsappIconName = $setting->whatsappIcon;
                if (\File::exists(public_path('/images/settings/whatsappIconName'.$whatsappIconName))) {
                    unlink(public_path('/images/settings/whatsappIconName'.$whatsappIconName));
                }
                $image = $request->file('whatsappIcon');
                $whatsappIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/whatsappIconName'.$whatsappIconName));
            }else{
                $whatsappIconName = $setting->whatsappIcon;
            }

            //twitterIcon 
            if($request->twitterIcon != NULL){
                $twitterIconName = $setting->twitterIcon;
                if (\File::exists(public_path('/images/settings/twitterIconName'.$twitterIconName))) {
                    unlink(public_path('/images/settings/twitterIconName'.$twitterIconName));
                }
                $image = $request->file('twitterIcon');
                $twitterIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/twitterIconName'.$twitterIconName));
            }else{
                $twitterIconName = $setting->twitterIcon;
            }

            //instagramIcon
            if($request->instagramIcon != NULL){
                $instagramIconName = $setting->instagramIcon;
                if (\File::exists(public_path('/images/settings/instagramIconName'.$instagramIconName))) {
                    unlink(public_path('/images/settings/instagramIconName'.$instagramIconName));
                }
                $image = $request->file('instagramIcon');
                $instagramIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/instagramIconName'.$instagramIconName));
            }else{
                $instagramIconName = $setting->instagramIcon;
            }


            //linkedinIcon 
            if($request->linkedinIcon != NULL){
                $linkedinIconName = $setting->linkedinIcon;
                if (\File::exists(public_path('/images/settings/linkedinIconName'.$linkedinIconName))) {
                    unlink(public_path('/images/settings/linkedinIconName'.$linkedinIconName));
                }
                $image = $request->file('linkedinIcon');
                $linkedinIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/linkedinIconName'.$linkedinIconName));
            }else{
                $linkedinIconName = $setting->linkedinIcon;
            }


            //googlePageIcon 
            if($request->googlePageIcon != NULL){
                $googlePageIconName = $setting->googlePageIcon;
                if (\File::exists(public_path('/images/settings/googlePageIconName'.$googlePageIconName))) {
                    unlink(public_path('/images/settings/googlePageIconName'.$googlePageIconName));
                }
                $image = $request->file('googlePageIcon');
                $googlePageIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/googlePageIconName'.$googlePageIconName));
            }else{
                $googlePageIconName = $setting->googlePageIcon;
            }


            //pinterestIcon 
            if($request->pinterestIcon != NULL){
                $pinterestIconName = $setting->pinterestIcon;
                if (\File::exists(public_path('/images/settings/pinterestIconName'.$pinterestIconName))) {
                    unlink(public_path('/images/settings/pinterestIconName'.$pinterestIconName));
                }
                $image = $request->file('pinterestIcon');
                $pinterestIconName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/settings/pinterestIconName'.$pinterestIconName));
            }else{
                $pinterestIconName = $setting->pinterestIcon;
            } 


            $setting->update([
                'websiteIcon' => $websiteIconName,
                'websiteTitle' => $request->websiteTitle, 
                'marqueeText' => $request->marqueeText,
                'headerFooterLogo' => $headerFooterLogoName,
                'companyName' => $request->companyName,
                'companyAddress' => $request->companyAddress,
                'telephone' => $request->telephone,
                'telephoneIcon' => $telephoneIconName,
                'fax' => $request->fax,
                'faxIcon' => $faxIconName,
                'mobile' => $request->mobile,
                'mobileIcon' => $mobileIconName,
                'email' => $request->email,
                'emailIcon' => $emailIconName,
                'facebook' => $request->facebook,
                'facebookIcon' => $facebookIconName,
                'whatsapp' => $request->whatsapp,
                'whatsappIcon' => $whatsappIconName,
                'twitter' => $request->twitter,
                'twitterIcon' => $twitterIconName,
                'instagram' => $request->instagram,
                'instagramIcon' => $instagramIconName,
                'linkedin' => $request->linkedin,
                'linkedinIcon' => $linkedinIconName,
                'googlePage' => $request->googlePage,
                'googlePageIcon' => $googlePageIconName,
                'pinterest' => $request->pinterest,
                'pinterestIcon' => $pinterestIconName,
                'googlemap' => $request->googlemap,
                'officeHours' => $request->officeHours,
                'copyrightText' => $request->copyrightText,
            ]);
            return redirect()->back()->with('message',"Settings has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
 