<?php
namespace App\Services;

use App\Models\Webapp\Company;
use COM;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Concat;

use function PHPSTORM_META\map;

class CsvService
{

    /**
     * App\Models\Company;
     */
 
    const COMPANIES_HEADER = array(
        'id',
        'company_code',
        'company_name',
        'company_name_short',
        'company_name_kana',
        'billing_address_postcode',
        'billing_address',
        'delivery_address_1',
        'delivery_address_2',
        'telephone_number',
        'fax_number',
        'email',
        'email_for_order',
        'cutoff_date',
        'cash_collection_date',
        'is_unit_price',
        'is_total',
        "created_at",
        "updated_at",
    );

    public function CompaniesExport()
    {
        $callback   =   function (){
            $stream =  fopen('php://output', 'w');
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            fputcsv($stream,self::COMPANIES_HEADER);
            $companies = Company::get()->toArray();
            foreach($companies as $company){
                $array = (array)$company;                
                fputcsv($stream,$array);
            }
            fclose($stream);
        };
        $name       =   sprintf('companies.csv', date('Ymd'));
        $headers    =   array(
            'Content-Type'  =>  'text/csv',
        );
        return response()->streamDownload($callback, $name, $headers);
    }
}