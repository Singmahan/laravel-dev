<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{
    // Create Index
    public function index(){
        $data['companies'] = Company::orderBy('id', 'asc')->paginate(5);
        return view('companies.index', $data);
    }

    // Create Data
    public function create(){
        return view('companies.create');
    }

    // Store data
    public function store(Request $request){
        // ทำการ validate form
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }
    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }
    // Update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been updated successfully.');
    }
    // Delete data
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully.');
    }
}
