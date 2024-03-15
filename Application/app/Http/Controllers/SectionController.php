<?php
namespace App\Http\Controllers;
use App\Models\Section;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $sections = Section::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.posts.sectionList')->with('sections', $sections);
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
            return view('admin.posts.addSections');
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
            //validation start here
            $rules = array(
                'sectionsName' => 'required',
                'status' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('sections/create')->withInput($request->input())->withErrors($validator);
            }else{
                $authUsers = Auth::user()->id;
                Section::create([
                    'sectionsName' => $request->sectionsName,
                    'slug' => strtolower(str_replace(' ', '_',$request->sectionsName)),
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'createdBy' => $authUsers,
                ]);
            }
            return redirect()->route('sections.index')->with('success',"Section has been created successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        try{
            $updateData = Section::where('id',$section->id)->first();
            return view('admin.posts.editSections')->with('updateData', $updateData);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        try{
            $authUsers= Auth::user()->id;
            $section->update([
                'sectionsName' => $request->sectionsName,
                'slug' => strtolower(str_replace(' ', '_',$request->sectionsName)),
                'status' => $request->status,
                'sort' => $request->sort,
                'updatedBy' => $authUsers,
            ]);
            return redirect()->route('sections.index')->with('success',"Section has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        try{
            if($section){
                $section->delete();
                return redirect()->route('sections.index')->with('delete','Sections has been deleted successfully!');
            }else{
                return redirect()->route('sections.index')->with('fail','There is a problem sections deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function sectionSearch()
    {
        try{
            if(request('keyword')){
                $sections = Section::where('sectionsName', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $sections = Section::latest()->paginate(10);
            }
            return view('admin.posts.sectionList')->with('sections', $sections);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

}
