<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use App\Models\Invite;
use App\Models\Tenant;
use App\Mail\InviteCreated;
use App\Notifications\InvitationSend;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Notifications\InviteNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class SubDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = DB::select('SELECT tenants.id, tenants.name, tenants.email, tenants.created_at, domains.domain
        FROM tenants, domains 
        WHERE tenants.id = domains.tenant_id');

        return view('domain.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:tenants,email',
            'subdomain' => 'required|unique:domains,domain',
        ]);

        $validator->after(function ($validator) use ($request) {
            if(Invite::where('email', $request->input('email'))->exists()) {
                $validator->errors()->add('email', 'Email adresa je zauzeta!');
            }
        });
        
        $validator->after(function ($validator) use ($request) {
            if(Domain::where('domain', $request->input('subdomain'). '.localhost')->exists()) {
                $validator->errors()->add('subdomain', 'Domen je vec zauzet!');
            }
        });



        if($validator->fails()) {
            return redirect('/domain')
            ->withErrors($validator)
            ->withInput();
        }

        do {  
                      
            $token = Str::random(30);  //generate a random string using Laravel's str_random helper

        }  while (Invite::where('token', $token)->first()); //check if the token already exists and if it does, try again

        $invite = Invite::create([
            'token' => $token,
            'email' => $request->input('email'),
            'subdomain' => $request->input('subdomain'),
        ]);

        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        $tenant = Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $tenant->domains()->create(['domain' => $request->subdomain . '.localhost']);
        
        return redirect('/domain')->with('message', 'Uspesno ste dodali poddomen.'. "<a style='color: lightblue;' href='/domains'>Lista domena</a>"); 
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($domain_id)
    {
        $tenant = Tenant::find($domain_id);
        $tenant->delete();

        return redirect('/domains')->with('message', 'Uspesno ste obrisali domen.');
    }

    public function accept($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        $invite->delete();

        return view('/prihvati', compact('invite'));
    }
}
