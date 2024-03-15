<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $pages = Page::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.pages.pages')->with('pages', $pages);
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
            $parentPagesName = Page::where('parentPage',0)->orderBy('sorts','asc')->get();
            return view('admin.pages.addNewPages')->with('parentPagesName', $parentPagesName);
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
                'pageName' => 'required',
                'pageTitle' => 'required',
                'status' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('pages/create')->withInput($request->input())->withErrors($validator)
                ->with('message',"Page name, Page title, Status Required");
            }else{
                $authUsers= Auth::user()->id;
                Page::create([
                    'pageName' => $request->pageName,
                    'pageTitle' => $request->pageTitle,
                    'slug' => strtolower(str_replace(' ', '_',$request->pageName)),
                    'pageLinks' => $request->pageLinks,
                    'parentPage' => $request->parentPage,
                    'pageBody' => $request->pageBody,
                    'status' => $request->status,
                    'sorts' => $request->sorts,
                    'createBy' => $authUsers,
                ]);
            }
            return redirect()->route('pages.index')->with('success',"Page has been created successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        try{
            $updateData = Page::where('id',$page->id)->first();
            $parentPagesName = Page::where('parentPage',0)->orderBy('sorts','asc')->get();
            return view('admin.pages.edit')
            ->with('updateData', $updateData)
            ->with('parentPagesName', $parentPagesName);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        try{
            $rules = array(
                'pageName' => 'required',
                'pageTitle' => 'required',
                'status' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('pages/update')->withInput($request->input())->withErrors($validator)
                ->with('message',"Page name, Page title, Status Required");
            }else{
                $authUsers= Auth::user()->id;
                $page->update([
                    'pageName' => $request->pageName,
                    'pageTitle' => $request->pageTitle,
                    'slug' => strtolower(str_replace(' ', '_',$request->pageName)),
                    'pageLinks' => $request->pageLinks,
                    'parentPage' => $request->parentPage,
                    'pageBody' => $request->pageBody,
                    'status' => $request->status,
                    'sorts' => $request->sorts,
                    'updatedBy' => $authUsers,
                ]);
            }
            return redirect()->route('pages.index')->with('success',"Page has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try{
            if($page){
                $page->delete();
                return redirect()->route('pages.index')->with('delete','Page has been deleted successfully!');
            }else{
                return redirect()->route('pages.index')->with('delete','There is a problem category deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pageSearch()
    {
        try{
            if(request('keyword')){
                $pages = Page::where('pageName', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $pages = Page::latest()->paginate(10);
            }
            return view('admin.pages.pages')->with('pages', $pages);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    
    public function pstrash(){        
        try{
            $deletedDatas = Page::onlyTrashed()->get();
            return view('admin.pages.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function psrestore($id){       
        try{
            $restoreData = Page::onlyTrashed()->findOrFail($id);
            $restoreData->restore();

            $deletedDatas = Page::onlyTrashed()->get();
            return view('admin.pages.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function psdelete($id){       
        try{
            $delete = Page::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();

            $deletedDatas = Page::onlyTrashed()->get();
            return view('admin.pages.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function pdf(){
        $pages = Page::all();
        $fileName = 'pages.pdf';
        view('admin.pages.pdf');
        $html = view('admin.pages.pdf', compact('pages'))->render();
        $mpdf = new \Mpdf\Mpdf();

        // Define header and footer content
        $settingData = DB::table('settings')->first();
        $header = '<div style="text-align: left; font-size: 12px;">'
            . '<img src="' . asset('Application/public/images/settings/headerFooterLogoName' . $settingData->headerFooterLogo) . '" alt="Logo" height="35" width="180">' 
            . '</div>';

        $footer = '<div style="text-align: right; font-size: 12px;">'
            . ' Page {PAGENO} of {nb}' . 
        '</div>';
        
        // take margin under header section
        $mpdf = new \Mpdf\Mpdf([
            'margin_top' => 25,
        ]);

        // Set header and footer content for use header and footer
        $mpdf->SetHeader($header);
        $mpdf->SetFooter($footer);

        // Remove underline from header and footer
        $mpdf->SetDefaultBodyCSS('border-bottom', 'none');
        // Set header content
        $mpdf->SetHTMLHeader($header);
        // Set footer content
        $mpdf->SetHTMLFooter($footer);

        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }

}