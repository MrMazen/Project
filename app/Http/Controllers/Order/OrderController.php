<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Section;
use App\Models\Room;
use App\Http\Requests\PatientRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        $sections = Section::all();
        $rooms = Room::all();
        return view('ordering.order',compact('orders','sections','rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();

        $sections = Section::all();
        return view('ordering.add',compact('sections','rooms'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {

        try {

            $validate = $request->validated();

            Order::create([
                'name' => $request->name,
                'number_phone' => $request->number_phone,
                'gander' => $request->gander,

                'number_phone' => $request->number_phone,
                'section_id' => $request->section_id,
                'Room_id' => $request->Room_id,
                'count_user' => $request->count_user,
                'status' => ' تحت الطلب',
                'value_status' => 2,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
            ]);

    
      


        //$user = User::first();
        //$user->notify(new AddInvoice($invoice_id));
        // Notification::send($user, new AddInvoices($invoice_id));

        //$user = User::get();
        // $user = User::where('roles_name' == ['admin']);

        //$user = DB::table('users')->select('*')->where('roles_name','["admin"]')->first();
       // $Patient = Patient::latest()->first();

    //    Notification::send($user, new PatientNotification($Patient));

            session()->flash('add', 'تم الاضافه بنجاح');
            return redirect()->route('order.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    public function getcity($id){

        $Citys = Room::where('section_id',$id)->pluck('number_room','id');
        return $Citys;
    }

    public function get_hospital($id){

        $hospital = Room::where('section_id',$id)->pluck('count_user','id');
        return $hospital;
    }

    }
