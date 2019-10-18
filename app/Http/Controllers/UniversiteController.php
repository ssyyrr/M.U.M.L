<?php

//namespace App\Http\Controllers\API;
namespace App\Http\Controllers;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Universite;
use App\User;



class UniversiteController extends Controller
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



    public function index()
    {
        return Universite::orderBy('id','ASC')
                            ->paginate(5);

    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User Add profiles 'Users.vue'

        $this->validate($request,[
             'intitule' => 'required|string|max:191',
            'abrev' => 'required|string|max:10'
                  ]);

        return Universite::create([

            'intitule' => $request['intitule'],
            'abrev' => $request['abrev'],
                   ]);


    }



    public function update(Request $request, $id)
    {
        //User update profiles 'Users.vue'

        $universite = Universite::findOrFail($id);

        $this->validate($request,[
            'intitule' => 'required|string|max:191',
            'abrev' => 'required|string|max:10',
            ]);

        $universite->update($request->all());
        return ['message' => 'Updated the universite info success'];
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

        $universite = Universite::findOrFail($id);
        // delete the user

        $universite->delete();

        return ['message' => 'Universite Deleted'];
    }

    public function search()
    {

        if ($search = \Request::get('q'))
        {

            if (\Gate::allows('isSuperadministratorOrAdministrator'))

            {


                $universites = Universite:: orderBy('id','ASC')
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

            $universites = $this->index();
        }
        return $universites;
    }

}
