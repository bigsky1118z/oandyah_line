<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;

use App\Models\Api\LineApi;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiMessage;
use App\Models\Api\LineApiUser;
use App\Models\Api\LineApiReceive;
use App\Models\Api\LineApiReply;
use App\Models\Api\LineApiSend;
use App\Services\Api\LineApiService;
use Carbon\Carbon;
use DateTime;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\call;

class LineApiController extends Controller
{
    protected $line_api_service;

    public function __construct(LineApiService $line_api_service)
    {
        $this->line_api_service    =   $line_api_service;
    }

    /** POST webhook  */
        public function receive_webhook(Request $request, $channel_name)
        {
            if($request){
                $this->line_api_service->receive($request, $channel_name);
            }else{
            }
        }

    /** App\Console\Kanel.php で毎分定期実行 */
        //必ず public static function にする
   
        public static function schedule_sending()
        {
            $sends   =   LineApiSend::where("schedule_at", "<=" ,new DateTime())
                ->whereStatus("reserve")
                ->whereNull("sent_at")
                ->whereNull("response_status")
                ->get();
            foreach($sends as $send){
                $send   =   $send->sending();
                $send->save();
            }
        }


    /** /api/line */
        /** GET /api/line */
        public function index() 
        {
            $data   =   array(
                "channels"  =>  LineApiChannel::orderBy("user_id")->get(),
            );
            return view('admin.api.line.index', $data);
        }

    /** /api/line/{$channel_name}  */
        /** GET /api/line/{$channel_name} */
        /** GET /api/line/{$channel_name}/user */

        public function statistics(Request $request, $channel_name)
        {
            $data   =   array(
                "statistics"   =>  $this->line_api_service->get_statistics($request, $channel_name),
            );
            return view("admin.api.line.statistics", $data);
        }


}