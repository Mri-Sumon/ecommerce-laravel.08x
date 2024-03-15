<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;

class LayoutsController extends Controller
{
    public function master(){
        return view('layouts.master');
    }
    
    public function sidebar(){
        try{
            return view('layouts.sidebar');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }
    
    public function topbar(){
        return view('layouts.topbar');
    }
}
