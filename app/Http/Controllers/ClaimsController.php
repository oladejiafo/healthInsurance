<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use App\Models\Providers;
use App\Models\Enrollees;
use App\Models\Clients;
use App\Models\Tariff;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class ClaimsController extends Controller
{
    // public function claims(ClaimsDataTable $dataTable) {
    //     return $dataTable->render('claims.claims');
    // }

    // public function claims_summary(ClaimsSumDataTable $claimsTable){
    //     return $claimsTable->render('claims.claims-summary');
    // }



    //$role = Role::create(['name' => 'admin']);

    // usage
    // $user->assignRole('admin');
    // if ($user->hasRole('admin')) {
    //     // do something
    // }

    public function claims(Request $request) {
        if (Auth::id()) {

            $hcp_name = $request->query('hcp_name');
            $month = $request->query('month');
            $year = $request->query('year');

            $claims = DB::table('claims')
            ->select(DB::raw('id, `hcp_code`, `hcp_name`, `enrollee_code`, `enrollee_name`,`claim_amount`,`entry_date`, `authorization_code`, `month`, `year`,`status`, `diagnosis`'))
            ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            ->where('hcp_name', '=', $hcp_name)
            ->where('year', '=', $year)
            ->where('month','=', $month)
            ->orderByDesc('id')
            ->get();

            return view('claims.claims',compact('claims'));
        } else {
            return redirect('/');
        }
    }

    public function claimsSummary(){
    
        if (Auth::id()) {

            $claims = DB::table('claims')
            ->select(DB::raw('COUNT(id) as ID, `hcp_code`, `hcp_name`, SUM(`claim_amount`) as amt, `month`, `year`'))
            ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            ->groupBy('hcp_code', 'hcp_name', 'month', 'year')
            ->orderByDesc('id')
            ->get();

            return view('claims.claims-summary',compact('claims'));
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
              // $enrollees = Enrollees::all();
        $clients = Clients::all();

        return view('registers.clients', compact('clients'));      
        } else {
            return redirect('/');
        }

    }

    public function tariffs()
    {
        $user = auth()->user(); // get the currently authenticated user
        $role = $user->role; // get the user's Role model
        $roleName = $role->name; // get the name of the user's role
       
        $permissions = $role->permissions; // get the permissions associated with the user's role
        // do something with the user's role and permissions

        if (Auth::id()) {
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

}
