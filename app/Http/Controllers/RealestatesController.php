<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realestate;
use App\Detail;
use App\Season;
use Session;

class RealestatesController extends Controller
{
    /**
     * Display a listing of the resource.
     * Display all realestates for the authenticated user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('realestates.all')->with('realestates',Realestate::All());
    }

    /**
     * Show the form for creating a new resource.
     * Display creat realestates form for authenticated user
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('realestates.create')->with('details',Detail::All());
    }

    /**
     * Store a newly created resource in storage.
     * save realestatesin database
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate the form data and set custom error message
        $realestate = $request->validate([
          'name' => 'required',
          'image' => 'required|image',
          'details' => 'required'
        ],
        [
          'name.required' => 'يجب ادخال اسم العقار',
          'image.required' => 'يجب رفع صورة',
          'details.required' => 'يجب اختيار تفاصيل'
          ]  );
        //upload realestate image
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads',$image_new_name);
        //insert realestate to database
        $realestate = new Realestate;
        $realestate->name = $request->name;
        $realestate->image = $image_new_name;
        $realestate->save();
        //add the details to realestate
        $realestate->details()->attach($request->details);

        //add price on season for the realestate
        $price = $request->input('price');
        $i=0;
        foreach ($price as $row)
        {
           $charges[] = [
               'price' => $row,
               'name' =>  $request->input('seasonname')[$i], //$row['seasonname'],
               'dateto' => $request->input('to')[$i], //$row['to'],
               'datefrom' => $request->input('from')[$i], //$row['from'],
               'realestate_id' => $realestate->id,
           ];
           $i++;
        }
        Season::insert($charges);
        Session::flash('success','تم اضافة العقار بنجاح');
        return redirect()->route('realestates');
    }

    /**
     * Display the specified resource.
     * Show realestate for visitor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('realestates.single')->with('realestate',Realestate::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     * show edit form for realestate.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $realestate = Realestate::find($id);
      return view('realestates.edit')->with('realestate',$realestate)
                                     ->with('details',Detail::All());
    }

    /**
     * Update the specified resource in storage.
     * save updated realestate
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validate the data
      $realestate = $request->validate(
        [
          'name' => 'required',
          'details' => 'required'
        ],
        [
          'name.required' => 'يجب ادخال اسم العقار',
          'image.required' => 'يجب رفع صورة',
          'details.required' => 'يجب اختيار تفاصيل'
          ]);
          //get the element by id
          $realestate = Realestate::find($id);
          //check if element has anew image for upload
          if($request->hasFile('image'))
          {
            //validate the image
              $realestate = $this->validate($request,[
                 'featured' => 'required|image',
              ],
              [
                'image.required' => 'يجب رفع صورة',
                ]);
              //upload the new image
              $image = $request->image;
              $image_new_name= time().$image->getClientOriginalName();
              $image->move('uploads',$image_new_name);
              // delete old image
              $filename = public_path().'/uploads/'.$realestate->image;
                \File::delete($filename);

              $realestate->image = $image_new_name;
          }

          //save changes to database
          $realestate->name = $request->name;
          $realestate->save();
          //update element details
          $realestate->details()->sync($request->details);

          Season::where('realestate_id', $id)->delete();
          $price = $request->input('price');
          $i=0;
          foreach ($price as $row)
          {
             $charges[] = [
                 'price' => $row,
                 'name' =>  $request->input('seasonname')[$i], //$row['seasonname'],
                 'dateto' => $request->input('to')[$i], //$row['to'],
                 'datefrom' => $request->input('from')[$i], //$row['from'],
                 'realestate_id' => $realestate->id,
             ];
             $i++;
          }
          Season::insert($charges);

          Session::flash('success','تم تعديل العقار');
          return redirect()->route('realestates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the state data
        $realestate = Realestate::find($id);
        $realestate->delete();
        Detail_realestate::where('post_id', $id)->delete();
        Season::where('realestate_id', $id)->delete();
        Session::flash('success','تم حذف العقار');
        return redirect()->back();
    }
  /////////////////////////////////////////////////////////////
  //REmove the season by ajax to add new
  public function removeseason(Request $request)
   {
       $season=Season::find($request->id);
       $season->delete();
       return "done";
   }
  /////////////////////////////////////////////////////////////////
  //show all realestates for visitors
  public function showall()
  {
    $this->middleware('auth');
    $realestates=Realestate::paginate(15);
    return view('realestates.showall')->with('realestates',$realestates);
  }
}
