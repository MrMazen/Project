<?php

namespace App\Http\Controllers\Section;
use App\Models\Section;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::all();
        return view ('Section.index',compact('sections'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
         try {

          $validate = $request->validated();

          $sections =new Section();

          $sections->name = $request->name;
          $sections->description = $request->description;

          $sections->save();

          session()->flash('add', 'تم الاضافه بنجاح');
          return redirect()->route('sections.index');

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
    public function update(StoreRequest $request)
    {
       

        try {

            $validated = $request->validated();
            //   $id= Provices::where('name',$request->name)->first()->id;
               $citys = Section::findOrFail($request->id);
     
               $citys->update([
                   'name' => $request->name,
                   'description' => $request->description,
               ]);

          session()->flash('edit', 'تم تعديل  بنجاح');
          return redirect()->route('sections.index');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $section = Section::findOrFail($request->id)->Delete();
      session()->flash('delete', 'تم الحذف بنجاح');
      return redirect()->route('sections.index');
  }    
}
