<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index(){
        // dd(request('tag'));
        // dd(Listing::latest()->filter(request(['tag','search']))->paginate(4));
        return view('listings.index',[
            'heading'=>'lastest Jobs',
            'listings'=>Listing::latest()->filter(request(['tag','search']))->simplePaginate(4)
        ]);
    }
    // Creating job post form
    public function create(){
        return view('listings.create');
    }
    // Store job post form data
    public function store(Request $request){
        // dd($request->all()); --this checks out submited form-data
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        // dd($request->hasFile('logo'));
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id']= auth()->id();
        Listing::create($formFields);
        return redirect('/')->with('message','Job listing Created Successfully');
    }


public function edit(Listing $listing){
    return view('listings.edit',['listing'=>$listing ]);
}
 
    // Store job post form data
    public function update(Request $request, Listing $listing){
        // dd($request->all()); --this checks out submited form-data

        // Making Sure that the logged user is the Owner of the listing before editing
        if($listing->user_id != auth()->id()){
            abort(403,"Unauthorized Action");  
        }
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        // dd($request->hasFile('logo'));
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id']= auth()->id();
        $listing->update($formFields);
        return back()->with('message','Job listing Updated Successfully');
    }

public function destroy(Listing $listing){
// Making Sure that the logged user is the Owner of the listing before Delete
        if($listing->user_id != auth()->id()){
            abort(403,"Unauthorized Action");  
        }
    $listing->delete();
    return redirect('/')->with('message','Listing Deleted');
}
// manage Listings
public function manage(Listing $listing){
    return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
}








    // show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'heading'=>'Single Jobs',
            'listing'=> $listing
        ]);
    }
    
}
