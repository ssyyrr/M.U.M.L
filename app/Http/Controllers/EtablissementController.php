<?php

//namespace App\Http\Controllers\API;
namespace App\Http\Controllers;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Etablissement;
use App\User;



class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:api');
    }



//    public function index(Request $request,$universite_id)
    public function index()
    {
        return Etablissement::orderBy('id','ASC')
//            ->where('universite_id',$universite_id)
            ->paginate(15);
    }
//    public function index(Request $request,$universite_id)
//    {
//        return Etablissement::orderBy('id','ASC')
//            ->where('universite_id',$universite_id)
//            ->paginate(15);
//    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Etablissement Add profiles 'Etablissements.vue'

        $this->validate($request,[
            'intitule' => 'required|string|max:191',
            'abrev' => 'required|string|max:10'
        ]);

        return Etablissement::create([

            'intitule' => $request['intitule'],
            'abrev' => $request['abrev'],
        ]);


    }



    public function update(Request $request, $id)
    {
        //Etablissement update profiles 'Etablissements.vue'

        $etablissement = Etablissement::findOrFail($id);

        $this->validate($request,[
            'intitule' => 'required|string|max:191',
            'abrev' => 'required|string|max:10',
        ]);

        $etablissement->update($request->all());
        return ['message' => 'Updated the Etablissement info success'];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isSuperadministrator') || $this->authorize('isAdministrator');

        $etablissement = Etablissement::findOrFail($id);
        // delete the Etablissement

        $etablissement->delete();

        return ['message' => 'Etablissement Deleted'];
    }

    public function search()
    {

        if ($search = \Request::get('q'))
        {

            if (\Gate::allows('isSuperadministratorOrAdministrator'))

            {


                $etablissements = Etablissement:: orderBy('id','ASC')
                    ->where(
                        function($query) use ($search)
                        {
                            $query->where('intitule','LIKE',"%$search%")
                                ->orWhere('abrev','LIKE',"%$search%");
                        }
                    )
                    ->paginate(2);
            }
        }
        else{

            $etablissements = $this->index();
        }
        return $etablissements;
    }

}
