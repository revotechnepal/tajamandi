<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-vendor')){
            if ($request->ajax()) {
                $data = Vendor::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $editurl = route('vendor.edit', $row->id);
                        $deleteurl = route('vendor.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                                    <form action='$deleteurl' method='POST' style='display:inline;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='DELETE' />
                                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                ";

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('backend.vendor.index');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->user()->can('manage-vendor')){
            return view('backend.vendor.create');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->user()->can('manage-vendor')){
            $data = $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
                'district' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);

            $vendor = Vendor::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'district' => $data['district'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role_id' => 4
            ]);
            $vendor->save();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $vendor['role_id'],
                'password' => Hash::make('password'),
            ]);
            $user->save();

            return redirect()->route('vendor.index')->with('success', 'Vendor information added successfully.');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-vendor')){
            $vendor = Vendor::findorfail($id);
            return view('backend.vendor.edit', compact('vendor'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-vendor')){
            $vendor = Vendor::findorfail($id);
            $user = User::where('name', $vendor->name)->first();

            $data = $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
                'district' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);

            $vendor->update([
                'name' => $data['name'],
                'address' => $data['address'],
                'district' => $data['district'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            return redirect()->route('vendor.index')->with('success', 'Vendor information updated successfully.');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-vendor')){
            $vendor = Vendor::findorFail($id);
            $products = Product::where('vendor_id', $vendor->id)->get();
            if(count($products) == 0) {
                $user = User::where('name', $vendor->name)->first();
                $user->delete();
                $vendor->delete();
                return redirect()->route('vendor.index')->with('success', 'Vendor information deleted successfully.');
            } else {
                return redirect()->route('vendor.index')->with('failure', 'Vendor has products. Cannot delete.');
            }

        }else{
            return view('backend.permission.permission');
        }
    }
}
