<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $paymentmethods = Paymentmethod::orderBy('id','desc')->latest()->paginate(10);
            return view('admin.paymentsMethods.paymentMethods')->with('paymentmethods', $paymentmethods);
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
            return view('admin.paymentsMethods.addNewPaymentMethods');
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
            $rules = array(
                'logo' => ['required', File::types(['jpg', 'png', 'avif', 'webp'])->image()->min(1)->max(12 * 1024),],
                'transactionNumber' => 'required', 
                'operatorName' => 'required',
                'status' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('paymentsMethods/create')->withInput($request->input())->withErrors($validator);
            }else{

                $image = $request->file('logo');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(200,200)->save(public_path('/images/paymentMethods/logo'.$fileName));
                
                $authUsers= Auth::user()->id;
                
                Paymentmethod::create([
                    'logo' => $fileName,
                    'transactionNumber' => $request->transactionNumber,
                    'operatorName' => $request->operatorName,
                    'slug' => strtolower(str_replace(' ', '_',$request->operatorName)),
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'createdBy' => $authUsers,
                ]);
            }
            return redirect()->route('paymentsMethods.index')->with('success',"Payment Methods has been added successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $updateData = Paymentmethod::where('id', $id)->first();
            return view('admin.paymentsMethods.edit')->with('updateData', $updateData);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $image = $request->file('logo');
            if($image){
                $getfilename = Paymentmethod::where('id',$id)->value('logo');
                if ($getfilename) {
                    unlink(public_path('/images/paymentMethods/logo'.$getfilename));
                }
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(200,200)->save(public_path('/images/paymentMethods/logo'.$fileName));
            }else{
                $fileName = Paymentmethod::where('id',$id)->value('logo');
            }

            $authUsers = Auth::user()->id;
            $data = Paymentmethod::where('id',$id)->first();

            $data->update([
                'logo' => $fileName,
                'transactionNumber' => $request->transactionNumber,
                'operatorName' => $request->operatorName,
                'slug' => strtolower(str_replace(' ', '_',$request->operatorName)),
                'status' => $request->status,
                'sort' => $request->sort,
                'updatedBy' => $authUsers,
            ]);

            return redirect()->route('paymentsMethods.index')->with('success',"Payment Methods has been updated successfully!");
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if($id){
                $data = Paymentmethod::where('id',$id)->first();
                $data->delete();
                return redirect()->route('paymentsMethods.index')->with('delete','Payment Methods has been deleted successfully!');
            }else{
                return redirect()->route('paymentsMethods.index')->with('delete','There is a problem Payment Methods deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function paymentMethodsSearch()
    {
        try{
            if(request('keyword')){
                $paymentmethods = Paymentmethod::where('transactionNumber', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $paymentmethods = Paymentmethod::latest()->paginate(10);
            }
            return view('admin.paymentsMethods.paymentMethods')->with('paymentmethods', $paymentmethods);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pmtrash(){        
        try{
            $deletedDatas = Paymentmethod::onlyTrashed()->get();
            return view('admin.paymentsMethods.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pmrestore($id){       
        try{
            $restoreData = Paymentmethod::onlyTrashed()->findOrFail($id);
            $restoreData->restore();

            $deletedDatas = Paymentmethod::onlyTrashed()->get();
            return view('admin.paymentsMethods.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function pmdelete($id){       
        try{
            $getfilename = DB::table('paymentmethods')->where('id', $id)->value('logo');
            if ($getfilename != NULL){
                unlink(public_path('/images/paymentMethods/logo'.$getfilename));
            }

            $delete = Paymentmethod::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();

            $deletedDatas = Paymentmethod::onlyTrashed()->get();
            return view('admin.paymentsMethods.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


}
