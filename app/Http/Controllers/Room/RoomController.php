<?php

namespace App\Http\Controllers\Room;
use App\Models\Section;
use App\Models\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RoomRequset;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Rooms =Room::all();
        $sections = Section::all();
  
     return view('room.index',compact('Rooms','sections'));
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
    public function store(RoomRequset $request)
    {

        try {
        $validate = $request->validated();

        Room::create([

        'number_room' => $request->number_room,
        'section_id' => $request->section_id,
        'count_user' => $request->count_user,
        'status' => 'غير محجوزة',
              'value_status' =>2,
            
        'description' => $request->description,

        ]);

        session()->flash('add', 'تم الاضافه بنجاح');
        return redirect()->route('room.index');

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
        $room = Room::where('id',$id)->first();

        $sections = Section::all();
       
        return view('Room.editroom',compact('room','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequset $request)
    {
        try {

            $validated = $request->validated();
  
            $room = Room::findOrFail($request->room_id);
  
            $room->update([
                'number_room' => $request->number_room,
                'section_id' => $request->section_id,
                'count_user' => $request->count_user,
               
                    
                'description' => $request->description,
            ]);
  
            session()->flash('update','تم تعديل الغرفة بنجاح');
            return redirect()->route('room.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $Room = Room::findOrFail($request->room_id)->Delete();
        session()->flash('delete','تم الحذف بنجاح');
        return redirect()->route('room.index');

    }


    public function delete_all(Request $request)
    {

        $delete_all_id = explode(",", $request->delete_all_id);
        Room::whereIn('id', $delete_all_id)->Delete();
        session()->flash('edit','تم الحذف بنجاح');
        return redirect()->route('room.index');

    }

    public function Getrooms(){
        $Rooms = Room::where('value_status',2)->get();
        return view('room.Unreservedrooms',compact('Rooms'));

    }


    public function Getroomsreseved(){
        $Rooms = Room::where('value_status',1)->get();
        return view('room.reservedrooms',compact('Rooms'));

    }




    
}
