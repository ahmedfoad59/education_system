<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\items;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    use apiresponstrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id= $request->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:items|max:255',
            'body' => 'required',
            
            ]);
      
            if (!$validator->fails()) 
            {
            
            $sections=items::create($request->all());
            $sms_stor="the data of items inserted succssfuly";
            $data_stor=$request->all();
            $stat_stor=200;

            return $this-> get_respon( $data_stor, $stat_stor,$sms_stor);
            }
            
            return $this-> get_respon( null,404,$validator->errors());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(items $items)
    {
        $all_items=items::all();

        return $this-> get_respon( $all_items,200,"this is items that we have");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(items $items,$id)
    {
        if (DB::table('items')->where('id',$id)->exists()) 
        {
            $sho_one_cat=items::find($id);
            return $this-> get_respon( $sho_one_cat,200,"this is data of items");
            
        }else
        {
            
            return $this-> get_respon(null,203,"this items is not exist");
            
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, items $items,$id)
    {

        
        $validator_update = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:items,title,'.$id,
            'body' => 'required',
            
            
            ]);

            if (!$validator_update->fails())
            {
                
                if (DB::table('items')->where('id', $id)->exists()) 
                {
                    $update_item=items::find($id)->update([
                           'title'=>$request->title,
                            'body'=>$request->body,
                            'example'=>$request->example,
                            'sec_id'=>$request->sec_id,
                      ]);
                      return $this-> get_respon($request->all(),200,"the data updated succssfully");
                 
                }else
                {
                    
                    return $this-> get_respon(null,203,"this items is not exist");
                   
                }
                
                
            }
  

            return $this-> get_respon( null,203,$validator_update->errors());



    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(items $items,$id)
    {
        if (DB::table('items')->where('id',$id)->exists()) 
        {
                $delet_cat=items::where('id',$id)->delete();

                return $this-> get_respon(null,200,"the data deleted succssfully");
            
        }else
        {
            
            return $this-> get_respon(null,203,"this items is not exist");
            
        }
    }
}
