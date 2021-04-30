<?php

namespace App\Http\Controllers;

use App\Models\DelieveryAddress;
use App\Models\Order;
use App\Models\OrderedProducts;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('manage-order')){
            $neworder = DB::table('notifications')->where('type','App\Notifications\NewOrderNotification')->where('is_read', 0)->get();
            foreach ($neworder as $order) {
                DB::update('update notifications set is_read = 1 where id = ?', [$order->id]);
            }

            if ($request->ajax()) {
                $data = Order::latest()->with('user')->with('status')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('customer', function($row) {
                            $customer = $row->user->name;
                            return $customer;
                        })
                        ->addColumn('address', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            $address = $delievery_address->address. ', '. $delievery_address->district;
                            return $address;
                        })
                        ->addColumn('phone', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            return $delievery_address->phone;
                        })
                        ->addColumn('email', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            return $delievery_address->email;
                        })
                        ->addColumn('date', function($row) {
                            $date = date('F j, Y', strtotime($row->created_at));
                            return $date;
                        })
                        ->addColumn('status', function($row) {
                            if ($row->status_id == 5) {
                                $date = '<span class="badge bg-green">'.$row->status->status.'</span>';
                            }elseif ($row->status_id == 6) {
                                $date = '<span class="badge bg-red">'.$row->status->status.'</span>';
                            }else {
                                $date = '<span class="badge bg-warning">'.$row->status->status.'</span>';
                            }
                            return $date;
                        })
                        ->addColumn('action', function($row){
                                $showurl = route('order.show', $row->id);
                            $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                            return $btn;
                        })
                        ->rawColumns(['customer','address', 'phone', 'email', 'status', 'action'])
                        ->make(true);
            }
            return view('backend.order.index');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findorFail($id);
        $ordered_products = OrderedProducts::where('order_id', $order->id)->with('product')->with('status')->get();
        $delievery_address = DelieveryAddress::where('id', $order->delievery_address_id)->first();
        return view('backend.order.show', compact('order', 'ordered_products', 'delievery_address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function notificationsread()
    {
        $notifications = DB::table('notifications')->where('is_read', 0)->get();
        foreach ($notifications as $notification) {
            DB::update('update notifications set is_read = 1 where id = ?', [$notification->id]);
        }

        return redirect()->back();
    }

    public function editaddress(Request $request, $id)
    {
        $delievery_address = DelieveryAddress::findorFail($id);

        $data = $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'town' => 'required',
            'district' => 'required',
        ]);

        $delievery_address->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'town' => $data['town'],
            'district' => $data['district'],
        ]);

        return redirect()->back()->with('success', 'Delevery address details updated successfully.');
    }

    public function deletefromorder($id)
    {
        dd($id);
    }
}
