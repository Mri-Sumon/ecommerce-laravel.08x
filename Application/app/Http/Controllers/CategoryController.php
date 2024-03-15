<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = Category::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.categories.categories')->with('categories', $categories);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('admin.categories.addNewCategory');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
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
                'categoryName' => 'required',
                'categoryImage' => ['required', File::types(['jpg', 'png', 'avif', 'webp'])->image()->min(1)->max(12 * 1024),],        
            );
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('categories/create')->withInput($request->input())->withErrors($validator);
            }else{
                
                //single image upload
                $image = $request->file('categoryImage');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/categories/categoryImage'.$fileName));

                $authUsers= Auth::user()->id;

                Category::create([
                    'categoryIcon' => $request->categoryIcon,
                    'categoryName' => $request->categoryName,
                    'slug' => strtolower(str_replace(' ', '_',$request->categoryName)),
                    'categoryImage' => $fileName,
                    'assignParentCategory' => $request->assignParentCategory,
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'createdBy' => $authUsers,
                ]);
            }
            //validation start here
            return redirect()->route('categories.index')->with('success',"Category has been created successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try{
            $singleShow = Category::where('id',$category->id)->first();
            return view('admin.categories.show')->with('singleShow', $singleShow);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        try{
            $updateData = Category::where('id',$category->id)->first();
            return view('admin.categories.edit')->with('updateData', $updateData);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {        
        try{
            $image = $request->file('categoryImage');
            if($image){
                $id = $category['id'];
                $getfilename=Category::where('id',$id)->value('categoryImage');
                if ($getfilename) {
                    unlink(public_path('/images/categories/categoryImage'.$getfilename));
                }

                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/categories/categoryImage'.$fileName));
            }else{
                $id = $category['id'];
                $fileName=Category::where('id',$id)->value('categoryImage'); 
            }

            $authUsers= Auth::user()->id;

            $category->update([
                'categoryIcon' => $request->categoryIcon,
                'categoryName' => $request->categoryName,
                'slug' => strtolower(str_replace(' ', '_',$request->categoryName)),
                'categoryImage' => $fileName,
                'assignParentCategory' => $request->assignParentCategory,
                'status' => $request->status,
                'sort' => $request->sort,
                'updatedBy' => $authUsers,
            ]);
            return redirect()->route('categories.index')->with('success',"Category has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            if($category){   
                $category->delete();
                return redirect()->route('categories.index')->with('delete','Category has been deleted successfully!');
            }else{
                return redirect()->route('categories.index')->with('delete','There is a problem category deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function categorySearch()
    {
        try{
            if(request('keyword')){
                $categories = Category::where('categoryName', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $categories = Category::latest()->paginate(10);
            }
            return view('admin.categories.categories')->with('categories', $categories);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function trash(){        
        try{
            $deletedDatas = Category::onlyTrashed()->get();
            return view('admin.categories.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function restore($id){       
        try{
            $restoreData = Category::onlyTrashed()->findOrFail($id);
            $restoreData->restore();

            $deletedDatas = Category::onlyTrashed()->get();
            return view('admin.categories.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function delete($id){       
        try{
            $getfilename = DB::table('categories')->where('id', $id)->value('categoryImage');
            if ($getfilename != NULL){
                unlink(public_path('/images/categories/categoryImage'.$getfilename));
            }

            $delete = Category::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();

            $deletedDatas = Category::onlyTrashed()->get();
            return view('admin.categories.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pdf(){
        $categories = Category::all();
        $fileName = 'categories.pdf';
        view('admin.categories.pdf');
        $html = view('admin.categories.pdf', compact('categories'))->render();
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
