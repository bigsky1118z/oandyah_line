<?php

namespace App\Http\Controllers\Admin\Webapp;

use App\Http\Controllers\Controller;
use App\Models\User\UserCompany;
use App\Models\Webapp\Company;
use App\Models\Webapp\CompanyAddress;
use App\Models\Webapp\CompanyEmail;
use App\Models\Webapp\CompanyOrderProduct;
use App\Models\Webapp\CompanyProvideProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Psy\CodeCleaner\ReturnTypePass;

use function Pest\version;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query  =   $request->all();
        $companies = Company::query();
        foreach ($query as $key => $value) {
            if ($value) {
                switch($key){
                    case("name"):
                        $companies->where("name", 'like', "%$value%")->orWhere("kana", 'like', "%$value%");
                        break;
                    case("pref"):
                        $companies->whereHas("addresses",function($query) use ($value) {
                            $query->Where("prefecture", $value);
                        });
                        break;
                    case("address"):
                        $companies->whereHas("addresses",function($query) use ($value) {
                            $query->Where("prefecture", "like", "%$value%")
                                ->orWhere("city", "like", "%$value%")
                                ->orWhere("street_address", "like", "%$value%")
                                ->orWhere("building_name", "like", "%$value%");
                        });
                        break;
                    case("email"):
                        $companies->whereHas("emails",function($query) use ($value) {
                            $query->where("email","like", "%$value%");
                        });
                        break;
                    case("initial"):
                        $initials  = explode("|",$value);
                        $companies->where(function($query) use ($initials) {
                            foreach($initials as $initial){
                                $query->orWhere("kana", "like", "$initial%");
                            }
                        });
                        break;
                    default:
                    $companies->where($key, 'like', "%$value%");
                }
            }
        }
        $companies  =   $companies->orderBy("kana")->get();
    
        $data = array(
            "companies" =>  $companies,
            "query" =>  $query,
        );
        return view('admin.webapp.company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   array(
            "resource"  =>  "create",
        );
        return view('admin.webapp.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,Company::rules());
        $company = new Company();
        $form = $request->all();
        unset($form['_token']);
        $company->fill($form)->save();
        if(isset($form['address'])){
            foreach($form['address'] as $address){
                $company_address    =   new CompanyAddress();
                $company_address->company_id    =   $company->id;
                $company_address->fill($address)->save();
            }
        }
        if(isset($form['email'])){
            foreach($form['email'] as $email){
                $company_email  =   new CompanyEmail();
                $company_email->company_id  =   $company->id;
                $company_email->fill($email)->save();
            }
        }
        return redirect("/admin/webapp/company");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data   =   array(
            "company"   =>  Company::find($id),
        );
        return view('admin.webapp.company.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = array(
            'company' => Company::find($id),
            "resource"  =>  "edit",
        );
        return view('admin.webapp.company.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,Company::rules());
        $company = Company::find($id);
        $form = $request->all();
        unset($form['_token']);
        $company->fill($form)->save();
        if(isset($form['address'])){
            foreach($form['address'] as $address_id => $address){
                if($address_id!="new"){
                    $company_address    =   CompanyAddress::find($address_id);
                    if(!empty(array_filter($address))){
                        $company_address->fill($address)->save();
                    }elseif(empty(array_filter($address))){
                        $company_address->delete();
                    }
                }
                if($address_id=="new" && !empty(array_filter($address))){
                    $company_address    =   new CompanyAddress();
                    $company_address->company_id    =   $company->id;
                    $company_address->fill($address)->save();
                }
            }
        }
        if(isset($form['email'])){
            foreach($form['email'] as $email_id => $email){
                if($email_id!="new"){
                    $company_email    =   CompanyEmail::find($email_id);
                    if(!empty(array_filter($address))){
                        $company_email->fill($email)->save();
                    }elseif(empty(array_filter($email))){
                        $company_email->delete();
                    }
                }
                if($email_id=="new" && !empty(array_filter($email))){
                    $company_email    =   new CompanyEmail();
                    $company_email->company_id    =   $company->id;
                    $company_email->fill($email)->save();
                }
            }
        }
        return redirect("/admin/webapp/company");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // foreach(CompanyAddress::whereCompanyId($id)->get() as $company_address){
        //     $company_address->delete();
        // }
        // foreach(CompanyEmail::whereCompanyId($id)->get() as $company_email){
        //     $company_email->delete();
        // }
        // foreach(CompanyProvideProduct::whereCompanyId($id)->get() as $company_provide_product){
        //     $company_provide_product->delete();
        // }
        // foreach(UserCompany::whereCompanyId($id)->get() as $user_company){
        //     $user_company->delete();
        // }
        // Company::find($id)->delete();
        return redirect("/admin/webapp/company");
    }
}
