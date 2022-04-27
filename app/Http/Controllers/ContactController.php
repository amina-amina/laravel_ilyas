<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index($id=null)
    {
       // $test =User::all();
        
       $user=User::all();
       //dd($user);
        //$contacts = Contact::all();
       // $contacts = Contact::orderBy('first_name','asc')->get();
       $companies= $user->companies()->orderBy('name')->pluck('name','id')->prepend('All Companies','');
    
       $page=$id;
       // dd(Contact::orderBy('id','desc')->where($page,'company_id'));)
       if($page==null)
            $contacts = $user->contacts()->orderBy('id','desc')->paginate(5);
            
       else
       $contacts = $user->contacts()->orderBy('id','desc')->where('company_id',$page)->paginate(5);
       
       return view('contacts.index' , compact('contacts','companies','page'));
       
    }
    public function create()
    {
        $user = auth()->user();
        $contact = new Contact();
        $companies= Company::orderBy('name')->pluck('name','id')->prepend('All Companies','');

        return view('contacts.create' , compact('companies' , 'contact'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'adress' => 'required',
            'company_id' =>'required|exists:companies,id',
        ]);
        //dd($request->all());
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message', "Contact has been added successfully");

    }

    public function edit($id)
    {
        $contact=Contact::findOrFail($id);
        $companies= Company::orderBy('name')->pluck('name','id')->prepend('All Companies','');
        return view('contacts.edit', compact('companies','contact'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'adress' => 'required',
            'company_id' =>'required|exists:companies,id',
        ]);
        //dd($request->all());
        $contact=Contact::findOrFail($id);
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message', "Contact has been updated successfully");
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contacts.show',compact('contact'));
    }
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('message' , "Contact has been deleted successfully");

    }
}
 
