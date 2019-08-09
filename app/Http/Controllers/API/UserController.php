<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Universite;
use App\Etablissement;
use Illuminate\Support\Facades\Hash;
use function PHPSTORM_META\type;


class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
//                                        // $this->authorize('isAdmin');

        if (\Gate::allows('isSuperadministratorOrAdministrator')) {
//            return User::latest() ->paginate(5);
//            $universites = Universite::all();
             return User::with('Universite')

                                     ->where('type', '!=', 'Superadministrator')
                                          ->orderBy('universite_id', 'ASC')
                                             ->orderBy('type', 'ASC')


                 ->paginate(5);




        }
        else{
            if( \Gate::allows('isEnseignant')){
                $etab = auth()->user()->etablissement_id;
                return User::with('Universite')
                                         ->where('type', '!=', 'Superadministrator')
                                        ->where('type', '!=', 'Administrator')

                                              ->where('etablissement_id',$etab)

                                                  ->orderBy('universite_id', 'ASC')
                                                    ->orderBy('type', 'ASC')

                                ->paginate(5);
            }
        }


     }

//
//User::whereDoesntHave('granteeReports',  function($q){
//    $q->where('year', '=',  2017 );
//})->get();






    public function store(Request $request)
    {
        //User Add profiles 'Users.vue'

        $this->validate($request,[
            'cin' => 'required|string|max:8|unique:users',
            'name' => 'required|string|max:191',
            'prenom' => 'required|string|max:191',
            'datenaissance' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
//            'universite_id' => 'required|string|max:191',
//            'etablissement_id' => 'required|string|max:191',
            'profile' => 'required|string|max:191',
            'grade' => 'required|string|max:191',
            'addresse' => 'required|string|max:191',
            'numtel' => 'required|string|max:191',
            'type' => 'required|string|max:191',
            'bio' => 'max:191'

        ]);

        return User::create([

            'cin' => $request['cin'],
            'name' => $request['name'],
            'prenom' => $request['prenom'],
            'datenaissance' => $request['datenaissance'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),

            'universite_id' => auth()->user()->universite_id,
            'etablissement_id' => auth()->user()->etablissement_id,

            'profile' => $request['profile'],
            'grade' => $request['grade'],
            'numtel' => $request['numtel'],
            'type' => $request['type'],
            'bio' => auth()->user()->name ,

        ]);


    }
    public function update(Request $request, $id)
    {
        //User update profiles 'Users.vue'

        $user = User::findOrFail($id);

        $this->validate($request,[
            'cin' => 'required|string|max:8',
            'name' => 'required|string|max:191',
            'prenom' => 'required|string|max:191',
            'datenaissance' => 'required|string|max:191',

            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6|',

            'universite_id' => 'required|string|max:191',
            'etablissement_id' => 'required|string|max:191',

            'profile' => 'required|string|max:191',
            'grade' => 'required|string|max:191',
            'numtel' => 'required|string|max:191',
            'type' => 'required|string|max:191',

        ]);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }


        $user->update($request->all());
        return ['message' => 'Updated the user info success'];
    }



    public function updateProfile(Request $request)
    {
        //User update profile 'Profile.vue'

        $user = auth('api')->user();


        $this->validate($request,[
            'cin' => 'required|string|max:8',
            'name' => 'required|string|max:191',
            'prenom' => 'required|string|max:191',
            'datenaissance' => 'required|string|max:191',
//                    |date_format:Y-m-d|before:xxxx
//                     |date_format:d/m/YYYY
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6',
            'universite_id' => 'required|string|max:191',
            'etablissement_id' => 'required|string|max:191',
            'profile' => 'required|string|max:191',
            'grade' => 'required|string|max:191',
            'numtel' => 'required|string|max:191',
            'type' => 'required|string|max:191',

        ]);


        $currentPhoto = $user->photo;


        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }


        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }


        $user->update($request->all());
        return ['message' => "Update success"];
    }


    public function profile()
    {
        return auth('api')->user();
    }


    public function show($id)
    {
        //
    }

    public function destroy($id)
    {

        $this->authorize('isSuperadministrator') || $this->authorize('isAdministrator');

        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return ['message' => 'User Deleted'];
    }

    public function search(){

        if ($search = \Request::get('q'))
        {


            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                    ->orWhere('email','LIKE',"%$search%")
                    ->orWhere('cin','LIKE',"%$search%")
                ->orWhere('universite_id','LIKE',"%$search%")
                ->orWhere('etablissement_id','LIKE',"%$search%");

                ;
            })->paginate(20);

        }

        else{

            $users = User::latest()->paginate(5);
        }

        return $users;

    }

}
