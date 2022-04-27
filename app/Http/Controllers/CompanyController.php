<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index()
    {
        
       $companies =  auth()->user()->companies->paginate(10);
       return view('companies.index' , compact('companies'));
       
    }
    public function create()
    {
        $company = new Company();
        return view('companies.create',compact('company'));
       
    }
    public function store(CompanyRequest $request)
    {
        
        $request->user()->companies()->create($request->all());
        return redirect()->route('companies.index')->with('message',"Company has been added successufully");
    }

    public function edit(Company $company)
    {
        return view('companies.edit' , compact('company'));

    }

    public function update(CompanyRequest $request, Company $company)
    {
       $company->update($request->all());
       return redirect()->route('companies.index')->with('message',"Company has been updated successfully");
    }

    public function show(Company $company)
    {
        return view('companies.show' , compact('company'));
    }
    public function delete(Company $company)
    {
       $company->delete();
       return back()->with('message',"Company has been removed successfully");


    }
}
