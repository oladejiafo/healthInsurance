<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use App\Models\Providers;
use App\Models\Enrollees;
use App\Models\Clients;
use App\Models\Tariff;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class ClaimsController extends Controller
{

    //$role = Role::create(['name' => 'admin']);

    // usage
    // $user->assignRole('admin');
    // if ($user->hasRole('admin')) {
    //     // do something
    // }

    public function claimsDetail(Request $request)
    {
        if (Auth::id()) {

            $hcp_name = $request->query('hcp_name');
            $month = $request->query('month');
            $year = $request->query('year');

            // $claims = DB::table('claims')
            //     ->select(DB::raw('id, `hcp_code`, `hcp_name`, `enrollee_code`, `enrollee_name`,`claim_amount`,`entry_date`, `authorization_code`, `month`, `year`,`status`, `diagnosis`'))
            //     ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            //     ->where('hcp_name', '=', $hcp_name)
            //     ->where('year', '=', $year)
            //     ->where('month', '=', $month)
            //     ->orderByDesc('id')
            //     ->get();

            $claims = DB::table('claims')
                ->select('claims.id', 'claims.hcp_id', 'claims.enrollee_id', 'claim_amount', 'entry_date', 'authorization_code', 'month', 'year', 'claims.status', 'diagnosis',
                    'providers.code as hcp_code', 'providers.name as hcp_name',
                    'enrollees.code as enrollee_code', DB::raw("CONCAT(enrollees.first_name, ' ', enrollees.surname) as enrollee_name"))
                ->whereNotIn('claims.status', ['Paid', 'Vetted', 'Approved'])
                ->where('providers.name', '=', $hcp_name)
                ->where('year', '=', $year)
                ->where('month', '=', $month)
                ->join('providers', 'claims.hcp_id', '=', 'providers.id')
                ->join('enrollees', 'claims.enrollee_id', '=', 'enrollees.id')
                ->orderByDesc('claims.id')
                ->get();

            return view('claims.claims', compact('claims'));
        } else {
            return redirect('/');
        }
    }

    public function claimsSummary()
    {

        if (Auth::id()) {

            // $claims = DB::table('claims')
            //     ->select(DB::raw('COUNT(id) as ID, `hcp_code`, `hcp_name`, SUM(`claim_amount`) as amt, `month`, `year`'))
            //     ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            //     ->groupBy('hcp_code', 'hcp_name', 'month', 'year')
            //     ->orderByDesc('id')
            //     ->get();

            $claims = DB::table('claims')
                ->select(DB::raw('COUNT(claims.id) as ID, providers.code as hcp_code, `providers`.`name` as hcp_name, SUM(`claim_amount`) as amt, `month`, `year`'))
                ->whereNotIn('claims.status', ['Paid', 'Vetted', 'Approved'])
                ->leftJoin('providers', 'claims.hcp_id', '=', 'providers.id')
                ->groupBy('providers.code', 'providers.name', 'month', 'year')
                // ->orderByDesc('year','month' )
                ->orderByDesc('year')
                ->orderByDesc(DB::raw('
                        CASE month 
                            WHEN "January" THEN 1 
                            WHEN "February" THEN 2 
                            WHEN "March" THEN 3 
                            WHEN "April" THEN 4 
                            WHEN "May" THEN 5 
                            WHEN "June" THEN 6
                            WHEN "July" THEN 7
                            WHEN "August" THEN 8
                            WHEN "September" THEN 9
                            WHEN "October" THEN 10
                            WHEN "November" THEN 11
                            WHEN "December" THEN 12       
                        END
                        '))

                ->get();

            return view('claims.claims-summary', compact('claims'));
        } else {

            return redirect('/');
        }
    }

    public function claimsDestroy($id)
    {
        if (Auth::id()) {
            $clm = Claims::find($id);
            $clm->delete();
// dd($clm);
            return redirect('/claimsSummary')->with('success', 'Tariff has been deleted');
        } else {
            return redirect('/');
        }
    }

    public function createClaims()
    {
        $providers = Providers::all();
        $enrollees = Enrollees::all();
        return view('claims.createClaims', compact('providers','enrollees'));
    }
    public function storeClaims(Request $request)
    {
        $validatedData = $request->validate([
            'hcp_id' => 'required',
            'enrollee_id' => 'required',
            'pay_date' => 'required',
            // Add validation rules for other fields here
        ]);
    
        $claim = new Claim();
        $claim->hcp_id = $request->input('hcp_id');
        $claim->enrollee_id = $request->input('enrollee_id');
        $claim->pay_date = $request->input('pay_date');
        // Set other fields here
    
        $claim->save();
    
        return redirect()->route('claimsDetail')->with('success', 'Claim created successfully.');
    }
    
    public function editClaims(Claims $claim)
    {
        $providers = Providers::all();
        $enrollees = Enrollees::all();
        return view('claims.editClaims', compact('claim','providers','enrollees'));
    }


    public function claimsDashboard(){
        if (Auth::id()) {
            
            return view('dashboards.claimsinsight');
        } else {
            return redirect('/');
        }
    }    
    public function providersDashboard(){
        if (Auth::id()) {
            return view('dashboards.providersinsight');
        } else {
            return redirect('/');
        }
    }    

    public function providers()
    {
        if (Auth::id()) {
            $providers = Providers::all();
            return view('registers.providers', compact('providers'));
        } else {
            return redirect('/');
        }
    }

    public function enrollees()
    {
        if (Auth::id()) {
            // $enrollees = Enrollees::all();
            $enrollees = Enrollees::with('hcp')->get();

            return view('registers.enrollees', compact('enrollees'));
        } else {
            return redirect('/');
        }
    }

    public function clients()
    {
        if (Auth::id()) {

            $clients = Clients::all();

            return view('registers.clients', compact('clients'));
        } else {
            return redirect('/');
        }
    }

    public function tariffs()
    {

        if (Auth::id()) {

            $user = auth()->user(); // get the currently authenticated user
            $role = $user->role; // get the user's Role model
            $roleName = $role->name; // get the name of the user's role
            $permissions = $role->permissions; // get the permissions associated with the user's role
            // do something with the user's role and permissions

            $tariffs = Tariff::all();

            return view('registers.tariffs', compact('tariffs'));
        } else {

            return redirect('/');
        }
    }

    public function create()
    {
        if (Auth::id()) {
            return view('registers.tariffs-create');
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if (Auth::id()) {
            $request->validate([
                'type' => 'required',
                'category' => 'required',
                'name' => 'required',
                'price' => 'required|numeric',
                'provider' => 'required',
            ]);

            $tariff = new Tariff([
                'type' => $request->get('type'),
                'category' => $request->get('category'),
                'name' => $request->get('name'),
                'sub_category' => $request->get('sub_category'),
                'price' => $request->get('price'),
                'provider' => $request->get('provider'),
            ]);

            $tariff->save();

            return redirect('/tariffs')->with('success', 'Tariff has been added');
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if (Auth::id()) {
            $tariff = Tariff::find($id);
            return view('registers.tariffs-edit', compact('tariff'));
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::id()) {
            $request->validate([
                'type' => 'required',
                'category' => 'required',
                'name' => 'required',
                'price' => 'required|numeric',
                'provider' => 'required',
            ]);

            $tariff = Tariff::find($id);
            $tariff->type = $request->get('type');
            $tariff->category = $request->get('category');
            $tariff->name = $request->get('name');
            $tariff->sub_category = $request->get('sub_category');
            $tariff->price = $request->get('price');
            $tariff->provider = $request->get('provider');
            $tariff->save();

            return redirect('/tariffs')->with('success', 'Tariff has been updated');
        } else {
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        if (Auth::id()) {
            $tariff = Tariff::find($id);
            $tariff->delete();

            return redirect('/tariffs')->with('success', 'Tariff has been deleted');
        } else {
            return redirect('/');
        }
    }

    public function show(Tariff $tariff)
    {
        if (Auth::id()) {
            return view('registers.tariffs-view', compact('tariff'));
        } else {
            return redirect('/');
        }
    }

    public function viewUser()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();
        return view('users.view', compact('roles', 'permissions', 'users'));
    }
    public function createUser()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role_id']
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create user: ' . $e->getMessage()]);
        }

        if (isset($validatedData['permissions'])) {
            $user->permissions()->attach($validatedData['permissions']);
        }

        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create user']);
        }

        return redirect()->route('viewUser')->with('success', 'User created successfully');
    }
}
