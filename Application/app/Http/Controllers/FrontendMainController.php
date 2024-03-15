<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Media;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;	
use App\Mail\FeedbackMail;


class FrontendMainController extends Controller
{
    public function master()
    {
        try{
            return view('frontendLayouts.master');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }
    


    public function topbar()
    {
        try{
            return view('frontendLayouts.topbar');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }



    public function sidebar()
    {
        try{
            return view('frontendLayouts.sidebar');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }



    public function footer()
    {
        try{
            return view('frontendLayouts.footer');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }


    public function categoryWiseProduct($id){
        try{
            $categoryWiseProducts = Product::where('categoryId',$id)->where('status', 'active')->orderBy('sort','asc')->get();
            return view('frontend.categoryWiseProduct')->with('categoryWiseProducts',$categoryWiseProducts);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }   



    public function singleShow($id){
        try{
            $singleShow = Product::where('id',$id)->where('status', 'active')->first();
            return view('frontend.singleShow')->with('singleShow',$singleShow);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }   



    public function home()
    {
        try{
            $medias = Media::where('status', 'active')->orderBy('sort','asc')->get();
            $products = Product::where('status', 'active')->orderBy('sort','asc')->get();
            $latestProducts = Product::where('status', 'active')->orderBy('sort', 'desc')->latest()->take(10)->get();
            return view('home')
            ->with('medias', $medias)
            ->with('products', $products)
            ->with('latestProducts', $latestProducts);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }



    public function subPages($slug)
    {
        try{
            $parentPages = Page::where('parentPage', 0)->where('status', 'active')->orderBy('sorts','asc')->get();
            $pages = Page::where('slug', $slug)->get();
            $settings = Setting::where('id', '1')->first();
            return view('frontend.subPages')
            ->with('pages', $pages)
            ->with('settings', $settings)->with('parentPages', $parentPages);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }



    public function feedbackemail(Request $request){
        try{
            $rules = array(
                'name'=> 'required',
                'email'=> 'required',
                'subject'=> 'required',
                'message'=> 'required'
            );
            
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return redirect()->back()->with('fail', 'Some thing wrong contact with developer.');
            } else {
                $data = [ 
                        'name'=> $request->name,
                        'message'=> $request->message,
                        'subject'=> $request->subject,
                        'email'=> $request->email,
                    ];
                Mail::to('mrisumon121@gmail.com', 'Website Feedback')->send(new FeedbackMail($data));
                return redirect()->back()->with('success', 'Thanks for your feedback!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }  
     

    public function reviews(Request $request)
    {
        try{
            Review::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);
            return redirect()->back();
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!')->withInput();
        }
    }


    public function addToCart(Request $request, $id)
    {
        try{
            if(Auth::id()){
                $user = auth()->user();
                $products = Product::find($id);

                Cart::create([
                    'name' => $user->name,
                    'phone' => $user->phoneNumber,
                    'address' => $user->address,
                    'image' => $products->productImage,
                    'productName' => $products->productName,
                    'price' => $products->sellingPrice,
                    'qty' => $request->qty,
                ]);
                return redirect()->back()->with('success','Product Added Successfully!');

            }else{
                return redirect('login');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }



    public function cart()
    {
        try{
            $user = auth()->user();
            $items = Cart::where('phone', $user->phoneNumber)->get();
            return view('frontend.cart')->with('items', $items);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }



    public function deleteItem($id)
    {
        try{
            $data = Cart::find($id);
            $data->delete();
            return redirect()->back()->with('success','Item deleted successfully!');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }

    public function shippingAddress(){
        try{
            return view('frontend.shippingAddress');
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('message','Something wrong contact with developer!');
        }
    }


    public function confirmOrder(Request $request)
    {
        try {
            $user = auth()->user();
            $status = 'pending';

            //Product Id
            $productIds = $request->input('productId');
            $productIds = implode(',', $productIds);
            //Product Image
            $productImages = $request->input('productImage');
            $productImages = implode(',', $productImages);
            //Product Name
            $productNames = $request->input('productName');
            $productNames = implode(',', $productNames);
            //Product quantities
            $quantities = $request->input('qty');
            $quantities = implode(',', $quantities);
            //Product unitPrices
            $unitPrices = $request->input('unitPrice');
            $unitPrices = implode(',', $unitPrices);
            //Product totalPrices
            $totalPrices = $request->input('totalPrice');
            $totalPrices = implode(',', $totalPrices);

            Order::create([
                'userId' => $user->id,
                'userName' => $user->name,
                'userEmail' => $user->email,
                'userPhone' => $user->phoneNumber,
                'userAddress' => $user->address,
                'productId' => $productIds,
                'productImage' => $productImages,
                'productName' => $productNames,
                'qty' => $quantities,
                'unitPrice' => $unitPrices,
                'totalPrice' => $totalPrices,
                'subTotal' => $request->subTotal,
                'status' => $status,
            ]);

            DB::table('carts')->where('phone', $user->phoneNumber)->delete();
            return redirect('shippingAddress');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('message', 'Something went wrong. Please contact the developer.');
        }
    }







}
