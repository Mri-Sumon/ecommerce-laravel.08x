<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
Use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        try{
            $products = Product::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.products.products')
            ->with('productsData', $products);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function create()
    {
        try{
            return view('admin.products.addNewProducts');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function store(Request $request)
    {
        try{
            //validation start here
            $rules = array(
                'productName' => 'required',
                'productImage' => ['required', File::types(['jpg', 'png', 'avif', 'webp'])->image()->min(1)->max(12 * 1024),],
                'productImages' => 'required',
                'productDescription' => 'required',
                'status' => 'required',          
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('products/create')->withInput($request->input())->withErrors($validator);
            }else{

                //single image upload
                $image = $request->file('productImage');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/products/productImage'.$fileName));

                //Multiple image upload
                $images = $request->file('productImages');
                if($images){
                    $imagesname='';
                    foreach($images as $image){
                        $name = hexdec(uniqid()).'.'.$image->getClientoriginalExtension();
                        Image::make($image)->resize(800,800)->save(public_path('/images/products/productImages'.$name));

                        if($imagesname == ''){
                            $imagesname = $name;
                        }else{
                            $imagesname=$imagesname.','.$name;
                        }
                    }
                }

                //Selling price
                if($request->discountType == 'fixed' ){
                    $sellingPrice = $request->regularPrice - $request->discountAmount;
                }elseif($request->discountType == 'percent'){
                    $totalDiscount = $request->regularPrice * ($request->discountAmount/100);
                    $sellingPrice = $request->regularPrice - $totalDiscount;
                }else{
                    $sellingPrice = 00;
                }

                Product::create([
                    'productName' => $request->productName,
                    'brandName' => $request->brandName,
                    'productCode' => $request->productCode,
                    'regularPrice' => $request->regularPrice,
                    //Single image upload
                    'productImage' => $fileName,
                    //Multiple image upload
                    'productImages' => $imagesname,
                    'categoryId' => $request->categoryId,
                    'discountType' => $request->discountType,
                    'discountAmount' => $request->discountAmount,
                    //Selling Price
                    'sellingPrice' => $sellingPrice,
                    'status' => $request->status,
                    'featureProduct' => $request->featureProduct,
                    'topSellingProduct' => $request->topSellingProduct,
                    'sort' => $request->sort,
                    'tag' => $request->tag,
                    'productBrief' => $request->productBrief,
                    'productDescription' => $request->productDescription,
                    'brandDescription' => $request->brandDescription,
                ]);
            }
            //validation start here
            return redirect()->route('products.index')->with('message',"Product has been created successfully!");

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function show(Product $product)
    {
        try{
            $singleShow = Product::where('id',$product->id)->first();
            return view('admin.products.show')->with('singleShow', $singleShow);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function edit(Product $product)
    {
        try{
            $updateData = Product::where('id',$product->id)->first();
            return view('admin.products.edit')->with('updateData', $updateData); 
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function update(Request $request, Product $product)
    {
        try{
            //single image upload
            $image = $request->file('productImage');
            if($image){
                //Delete single image from laravel directory
                $id = $product['id'];
                $getfilename=Product::where('id',$id)->value('productImage');
                if ($getfilename) {
                    unlink(public_path('/images/products/productImage'.$getfilename));
                }
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800,800)->save(public_path('/images/products/productImage'.$fileName));
            }else{
                $id = $product['id'];
                $fileName = Product::where('id',$id)->value('productImage');
            }

            //Multiple image upload
            $images = $request->file('productImages');
            if($images){
                //Delete multiple images from laravel directory
                $id = $product['id'];
                $getfilenames=Product::where('id',$id)->value('productImages');
                $getSingleImageName = explode(",", $getfilenames);
                if ($getSingleImageName) {
                    for( $i = 0; $i < count($getSingleImageName); $i++){
                        unlink(public_path('/images/products/productImages'.$getSingleImageName[$i]));
                    }
                }
                $imagesname='';
                foreach($images as $image){
                    $name = hexdec(uniqid()).'.'.$image->getClientoriginalExtension();
                    Image::make($image)->resize(800,800)->save(public_path('/images/products/productImages'.$name));
                    if($imagesname == ''){
                        $imagesname = $name;
                    }else{
                        $imagesname=$imagesname.','.$name;
                    }
                }
            }else{
                $id = $product['id'];
                $imagesname = Product::where('id',$id)->value('productImages');
            }

            //Selling price
            if($request->discountType == 'fixed' ){
                $sellingPrice = $request->regularPrice - $request->discountAmount;
            }elseif($request->discountType == 'percent'){
                $totalDiscount = $request->regularPrice * ($request->discountAmount/100);
                $sellingPrice = $request->regularPrice - $totalDiscount;
            }else{
                $sellingPrice = 00;
            }

            $product->update([
                'productName' => $request->productName,
                'brandName' => $request->brandName,
                'productCode' => $request->productCode,
                'regularPrice' => $request->regularPrice,
                //Single image upload
                'productImage' => $fileName,
                //Multiple image upload
                'productImages' => $imagesname,
                'categoryId' => $request->categoryId,
                'discountType' => $request->discountType,
                'discountAmount' => $request->discountAmount,
                //Selling Price
                'sellingPrice' => $sellingPrice,
                'status' => $request->status,
                'featureProduct' => $request->featureProduct,
                'topSellingProduct' => $request->topSellingProduct,
                'sort' => $request->sort,
                'tag' => $request->tag,
                'productBrief' => $request->productBrief,
                'productDescription' => $request->productDescription,
                'brandDescription' => $request->brandDescription,
            ]);
    
            //validation start here
            return redirect()->route('products.index')->with('message',"Product has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }

    public function destroy(Product $product)
    {
        try{
            if($product){   
                $product->delete();
                return redirect()->route('products.index')->with('delete','Product has been deleted successfully!');
            }else{
                return redirect()->route('products.index')->with('delete','There is a problem product deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
 
    }

    public function productSearch()
    {
        try{
            if(request('keyword')){
                $products = Product::where('productName', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $products = Product::latest()->paginate(10);
            }
            return view('admin.products.products')->with('productsData', $products);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function ptrash(){        
        try{
            $deletedDatas = Product::onlyTrashed()->get();
            return view('admin.products.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function prestore($id){       
        try{
            $restoreData = Product::onlyTrashed()->findOrFail($id);
            $restoreData->restore();

            $deletedDatas = Product::onlyTrashed()->get();
            return view('admin.products.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pdelete($id){       
        try{

            $getfilename = DB::table('products')->where('id', $id)->value('productImage');
            if ($getfilename) {
                unlink(public_path('/images/products/productImage'.$getfilename));
            }

            $getfilenames = DB::table('products')->where('id', $id)->value('productImages');
            $getSingleImageName = explode(",", $getfilenames);
            if ($getSingleImageName) {
                for( $i = 0; $i < count($getSingleImageName); $i++){
                    unlink(public_path('/images/products/productImages'.$getSingleImageName[$i]));
                }
            }

            $delete = Product::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();

            $deletedDatas = Product::onlyTrashed()->get();
            return view('admin.products.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function pdf(){
        $products = Product::all();
        $fileName = 'products.pdf';
        view('admin.products.pdf');
        $html = view('admin.products.pdf', compact('products'))->render();
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