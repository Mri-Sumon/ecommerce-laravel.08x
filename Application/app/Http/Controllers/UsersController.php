<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
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

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $users = User::orderBy('id','asc')->latest()->paginate(10);
            return view('admin.users.users')->with('users', $users);
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
            return view('admin.users.addNewUsers');
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
        // dd($authUsers);
        try{
            $rules = array(
                'name' => 'required',  
                'email' => ['required', Rule::unique('users','email')],
                'phoneNumber' => 'required',
                'userType' => 'required',
                'status' => 'required', 
                'password' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return redirect('users/create')->withInput($request->input())->withErrors($validator)
                ->with('message',"Name, Email, Phone, User Type, Status and Password Required");
            }else{

                $authUsers= Auth::user()->id;
                
                // permission array convert as string 
                if($request->permissions){
                    $permissions = implode(',',$request->permissions);
                }else{
                    $permissions = "dashbaord";
                }

                //bcrypt() used for active login system
                if($request->password){
                    $password = bcrypt($request->password);
                }

                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                    'userType' => $request->userType,
                    'status' => $request->status,
                    'sort' => $request->sort,
                    'permissions' => $permissions,
                    'createdBy' => $authUsers,
                    'password' => $password,
                ]);
            }
            return redirect()->route('users.index')->with('message',"User has been created successfully!");

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try{
            $updateData = User::where('id',$user->id)->first();
            return view('admin.users.edit')->with('updateData', $updateData);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try{
            $authUsers= Auth::user()->id;

            if($request->permissions){
                $permissions = implode(',',$request->permissions);
            }else{
                $authUserPermissions= Auth::user()->permissions;
                $permissions = $authUserPermissions;
            }

            if($request->password){
                $password = bcrypt($request->password);
            }
            
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'userType' => $request->userType,
                'status' => $request->status,
                'sort' => $request->sort,
                'permissions' => $permissions,
                'createdBy' => $authUsers,
                'password' => $password,
            ]);
            return redirect()->route('users.index')->with('message',"User has been updated successfully!");

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
            if($user){
                $user->delete();
                return redirect()->route('users.index')->with('delete','Users has been deleted successfully!');
            }else{
                return redirect()->route('users.index')->with('fail','There is a problem user deletion!!');
            }
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function userSearch()
    {
        try{
            if(request('keyword')){
                $users = User::where('email', 'LIKE', '%'.request('keyword').'%')->latest()->paginate(10);
            }else{
                $users = User::latest()->paginate(10);
            }
            return view('admin.users.users')->with('users', $users);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function utrash(){        
        try{
            $deletedDatas = User::onlyTrashed()->get();
            return view('admin.users.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function urestore($id){       
        try{
            $restoreData = User::onlyTrashed()->findOrFail($id);
            $restoreData->restore();

            $deletedDatas = User::onlyTrashed()->get();
            return view('admin.users.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }

    public function udelete($id){       
        try{
            $delete = User::onlyTrashed()->findOrFail($id);
            $delete->forceDelete();

            $deletedDatas = User::onlyTrashed()->get();
            return view('admin.users.trash')->with('deletedDatas', $deletedDatas);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return redirect()->back()->with('fail','Something wrong contact with developer!')->withInput();
        }
    }


    public function pdf(){
        $users = User::all();
        $fileName = 'users.pdf';
        view('admin.users.pdf');
        $html = view('admin.users.pdf', compact('users'))->render();
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
