<?php

namespace App\Http\Controllers;
use App\Models\Media;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $medias = Media::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.posts.allSections')->with('medias', $medias);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('admin.posts.addPictures');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $rules = array(
                'pictures' => ['required', File::types(['jpg', 'png', 'avif', 'webp'])->image()->min(1)->max(12 * 1024),],
                'title' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('medias/create')->withInput($request->input())->withErrors($validator);
            }else{
                $image = $request->file('pictures');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/sections/section'.$fileName));

                $authUsers= Auth::user()->id;
                Media::create([
                    'pictures' => $fileName,
                    'link' => $request->link,
                    'title' => $request->title,
                    'description' => $request->description,
                    'sections' => $request->sections,
                    'slug' => strtolower(str_replace(' ', '_',$request->sections)),
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'createdBy' => $authUsers,
                ]);
            }
            return redirect()->route('medias.index')->with('success',"Sections data has been submitted successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function videos()
    {
        try{
            return view('admin.posts.addVideos');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
        
    }

    public function addVideos(Request $request)
    {
        try{
            $rules = array(
                'videos' => 'required',
                'title' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('medias/create')->withInput($request->input())->withErrors($validator);
            }else{
                $authUsers= Auth::user()->id;
                Media::create([
                    'videos' => $request->videos,
                    'title' => $request->title,
                    'description' => $request->description,
                    'sections' => $request->sections,
                    'slug' => strtolower(str_replace(' ', '_',$request->sections)),
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'createdBy' => $authUsers,
                ]);
            }
            $medias = Media::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.posts.allSections')->with('medias', $medias)->with('success',"Sections data has been submitted successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        try{
            $updateData = Media::where('id',$media->id)->first();
            return view('admin.posts.editSectionsBody')->with('updateData', $updateData);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        try{
            $image = $request->file('pictures');
            if($image){
                $id = $media['id'];
                $getfilename = Media::where('id',$id)->value('pictures');
                if ($getfilename) {
                    unlink(public_path('/images/sections/section'.$getfilename));
                }
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/sections/section'.$fileName));
            }else{
                $id = $media['id'];
                $fileName = Media::where('id',$id)->value('pictures'); 
            }

            $videos = $request->videos;
            if($videos){
                $videos = $request->videos;
            }else{
                $id = $media['id'];
                $videos = Media::where('id',$id)->value('videos'); 
            }

            $links = $request->link;
            if($links){
                $links = $request->link;
            }else{
                $id = $media['id'];
                $links = Media::where('id',$id)->value('link'); 
            }

            $authUsers= Auth::user()->id;
            $media->update([
                'pictures' => $fileName,
                'videos' => $videos,
                'link' => $links,
                'title' => $request->title,
                'description' => $request->description,
                'sections' => $request->sections,
                'slug' => strtolower(str_replace(' ', '_',$request->sections)),
                'status' => $request->status,
                'sort' => $request->sort,
                'updatedBy' => $authUsers,
            ]);
            return redirect()->route('medias.index')->with('success',"Data has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        try{
            if($media){
                $id = $media['id'];
                $getfilename = Media::where('id',$id)->value('pictures');
                if ($getfilename) {
                    unlink(public_path('/images/sections/section'.$getfilename));
                }

                $media->delete();
                return redirect()->route('medias.index')->with('delete','Data has been deleted successfully!');
            }else{
                return redirect()->route('medias.index')->with('delete','There is a problem data deletion!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function sectionBodySearch()
    {
        try{
            if(request('keyword')){
                $medias = Media::where('sections', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $medias = Media::latest()->paginate(10);
            }
            return view('admin.posts.allSections')->with('medias', $medias);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }
}
