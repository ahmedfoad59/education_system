<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\categoris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategorisController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

            $id= $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categoris',
            'discription' => 'required',
            
            ]);
      
            if ( !$validator->fails()) 
            {
            //   return response()->json($validator->errors()); 
            $sections=categoris::create($request->all());
            $sms_stor="the data of category inserted succssfuly";
            $data_stor=$request->all();
            $stat_stor=200;

            return $this-> get_respon( $data_stor, $stat_stor,$sms_stor);
            }
            
            return $this-> get_respon( null,404,$validator->errors());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoris  $categoris
     * @return \Illuminate\Http\Response
     */
    public function show(categoris $categoris)
    {
        $sections=categoris::all();

        return $this-> get_respon( $sections,200,"this is categoris that we have");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoris  $categoris
     * @return \Illuminate\Http\Response
     */
    public function edit(categoris $categoris,$id)
    {
        if (DB::table('categoris')->where('id',$id)->exists()) 
        {
            $sho_one_cat=categoris::find($id);
            return $this-> get_respon( $sho_one_cat,200,"this is data of category");
            
        }else
        {
            
            return $this-> get_respon(null,203,"this category is not exist");
            
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoris  $categoris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoris $categoris,$id)
    {
        
        $validator_update = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categoris,name,'.$id,
            'discription' => 'required',
            
            ]);

            if (!$validator_update->fails())
            {
                
                if (DB::table('categoris')->where('id', $id)->exists()) 
                {
                    $update_cat=categoris::find($id) ->update([
                        'name'=>$request->name,
                        'discription'=>$request->discription
                      ]);
                      return $this-> get_respon($request->all(),200,"the data updated succssfully");
                 
                }else
                {
                    
                    return $this-> get_respon(null,203,"this category is not exist");
                   
                }
                
                
            }
  

            return $this-> get_respon( null,203,$validator_update->errors());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoris  $categoris
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoris $categoris,$id)
    {
        if (DB::table('categoris')->where('id',$id)->exists()) 
        {
                $delet_cat=categoris::where('id',$id)->delete();

                return $this-> get_respon(null,200,"the data deleted succssfully");
            
        }else
        {
            
            return $this-> get_respon(null,203,"this category is not exist");
            
        }

     
        
    }
    public function getcatids()
    {
       
    }
}
