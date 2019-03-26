<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use Session;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('details.all')->with('details',Detail::All());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail = $this->validate($request,[
                'name' => 'required'
              ],
              ['name.required' => 'يجب ادخال اسم الخاصية']
            );
        $detail = new Detail;
        $detail->name=$request->name;
        $detail->save();
        Session::flash('success','تم الاضافة بنجاح');
        return redirect()->route('details');
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
        return view('details.edit')->with('detail',Detail::find($id));
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
      $detail = $this->validate($request,[
              'name' => 'required'
            ],
            ['name.required' => 'يجب ادخال اسم الخاصية']
          );
          $detail = Detail::find($id);
          $detail->name=$request->name;
          $detail->save();
          Session::flash('success','تم التعديل بنجاح');
          return redirect()->route('details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = Detail::find($id);
        $detail->delete();
        Session::flash('success','تم الحذف بنجاح');
        return redirect()->back();
    }
}
