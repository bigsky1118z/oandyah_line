<?php

namespace App\Http\Controllers\Kbox;

use App\Http\Controllers\Controller;
use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Company\KboxCompanyAddress;
use App\Models\Kbox\Company\KboxCompanyContact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class KboxCompanyController extends Controller
{
    public static function schedule_backup_database()
    {
        $path   =   "company";
        Storage::disk("kbox")->exists($path) ? Storage::disk("kbox")->makeDirectory($path, 0775, true) : null;
        $databases  =   array(
            "kbox_companies", 
            "kbox_company_addresses",
            "kbox_company_billings", 
            "kbox_company_contacts",
            "kbox_company_slips",
        );
        foreach($databases as $database){
            Storage::disk("kbox")->exists("$path/$database") ? Storage::disk("kbox")->makeDirectory("$path/$database", 0775, true) : null;
            KboxCompany::generate_csv($database);
            $contents   =   file_get_contents($database . ".csv");
            Storage::disk("kbox")->put($path . "/" . $database . ".csv", $contents);
        }
    }

    public function hoge()
    {
        $csv    =   Storage::disk("kbox")->get("company/kbox_company_addresses.csv");
        if($csv){
            $kbox_company_addresses =   array();
            foreach(explode(PHP_EOL, $csv) as $line){
                $line ? $kbox_company_addresses[] = str_getcsv($line) : null;
            }
            $headers    =   array_shift($kbox_company_addresses);
            foreach($kbox_company_addresses as $kbox_company_address){
                if(count($headers) == count($kbox_company_address)){
                    $company    =   KboxCompany::whereName($kbox_company_address[array_search("kbox_company", $headers)])->first();
                    if($company){
                        $name       =   $kbox_company_address[array_search("name", $headers)];
                        $zip_code   =   $kbox_company_address[array_search("zip_code", $headers)];
                        $prefecture =   $kbox_company_address[array_search("prefecture", $headers)];
                        $city       =   $kbox_company_address[array_search("city", $headers)];
                        $town       =   $kbox_company_address[array_search("town", $headers)];
                        $other      =   $kbox_company_address[array_search("other", $headers)];
                        $company->set_address($name, $zip_code, $prefecture, $city, $town, $other);
                    }
                }
            }
        }



        $database   =   "kbox_companies.csv";
        $mime_type  =   Storage::mimeType("kbox/company/$database");

        $csv        =   Storage::disk("kbox")->get("company/$database");
        // $headers    =   array(
        //     "Content-Type"          =>  $mime_type,
        //     "Content-Disposition"   =>  "attachment; filename=$database",
        // );
        // return response($csv)->withHeaders($headers);
        
        $data   =   array();
        foreach(explode(PHP_EOL, $csv) as $line){
            $data[] =   str_getcsv($line);
        }
        $headers    =   array_shift($data);

        return $data;

        return $csv;
    }

    public function index()
    {
        $data   =   array(
            "companies" =>  KboxCompany::all()->groupBy("category"),
        );
        return view("kbox.company.index", $data);
    }

    public function show($company_id)
    {
        $data   =   array(
            "company" =>  KboxCompany::find($company_id),
        );
        return view("kbox.company.show", $data);
    }

    public function import(Request $request, $database)
    {
        if($request->hasFile("csv")){
            $path   =   $request->file("csv")->path();
            $file   =   new SplFileObject($path);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
            $data   =   array();
            foreach($file as $row){
                $data[] =   $row;
            }
            $headers    =   array_shift($data);
            foreach($data as $datum){
                switch($database){
                    case "kbox_companies":
                        $columns    =   array("category","name","code","company_type","kana");
                        if(empty(array_diff($columns, $headers))){
                            KboxCompany::updateOrCreate(
                                array(
                                    "category"      =>  $datum[array_search("category", $headers)],
                                    "name"          =>  $datum[array_search("name", $headers)],
                                ),
                                array(
                                    "code"          =>  $datum[array_search("code", $headers)],
                                    "company_type"  =>  $datum[array_search("company_type", $headers)],
                                    "kana"          =>  $datum[array_search("kana", $headers)],
                                )
                            );
                        } else {

                        }
                        break;
                    case "kbox_company_addresses":
                        $columns    =   array("kbox_company","name","zip_code","prefecture","city","town","other");
                        if(empty(array_diff($columns, $headers))){
                            $company    =   KboxCompany::whereName($datum[array_search("kbox_company", $headers)])->first();
                            if($company){
                                $name       =   $datum[array_search("name", $headers)];
                                $zip_code   =   $datum[array_search("zip_code", $headers)];
                                $prefecture =   $datum[array_search("prefecture", $headers)];
                                $city       =   $datum[array_search("city", $headers)];
                                $town       =   $datum[array_search("town", $headers)];
                                $other      =   $datum[array_search("other", $headers)];
                                $company->set_address($name, $zip_code, $prefecture, $city, $town, $other);
                            }
                        } else {

                        }
                        break;
                    case "kbox_company_contacts":
                        $columns    =   array("kbox_company","name","type","category","value","description");
                        if(empty(array_diff($columns, $headers))){
                            $company    =   KboxCompany::whereName($datum[array_search("kbox_company", $headers)])->first();
                            if($company){
                                $type           =   $datum[array_search("type", $headers)];
                                $category       =   $datum[array_search("category", $headers)];
                                $name           =   $datum[array_search("name", $headers)];
                                $value          =   $datum[array_search("value", $headers)];
                                $description    =   $datum[array_search("description", $headers)];
                                $company->set_contact($type, $category, $name, $value, $description);
                            }
                        }
                        break;
                }
            }
            $data   =   array(
                "message" => "success",
            );
            return response()->json($data,200);
        }
    }

    public function export($database)
    {
        KboxCompany::generate_csv($database);
        $headers    =   array(
            "Content-Type"  =>  "text/csv",
        );
        $path       =   "company";
        $contents   =   file_get_contents($database . ".csv");
        Storage::disk("kbox")->exists("$path/$database") ? null : Storage::disk("kbox")->makeDirectory("$path/$database", 0775, true);
        Storage::disk("kbox")->put($path . "/" . $database . ".csv", $contents);
        return response()->download($database . ".csv", $database . ".csv", $headers);
    }

    public function address(Request $request, $company_id)
    {
        $company    =   KboxCompany::find($company_id);
        $address    =   $request->only(array(
            "name",
            "zip_code",
            "prefecture",
            "city",
            "town",
            "other",
        ));
        if($company){
            $company->set_address($address["name"], implode("-", $address["zip_code"]), $address["prefecture"], $address["city"], $address["town"], $address["other"]);
        }
        return redirect("/kbox/company/$company_id");
    }

    public function address_delete($company_id, $address_id)
    {
        $address    =   KboxCompanyAddress::whereKboxCompanyId($company_id)->whereId($address_id)->first();
        $address    ?   $address->delete()  :   null;
        return redirect("/kbox/company/$company_id");
    }

    public function contact(Request $request, $company_id)
    {
        $company    =   KboxCompany::find($company_id);
        $contact    =   $request->only(array(
            "type",
            "category",
            "name",
            "value",
            "description",
        ));
        if($company){
            $company->set_contact($contact["type"], $contact["category"], $contact["name"], $contact["value"], $contact["description"]);
        }
        return redirect("/kbox/company/$company_id");
    }

    public function contact_delete($company_id, $contact_id)
    {
        $contact    =   KboxCompanyContact::whereKboxCompanyId($company_id)->whereId($contact_id)->first();
        $contact    ?   $contact->delete()  :   null;
        return redirect("/kbox/company/$company_id");
    }
}
