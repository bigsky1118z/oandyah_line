<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiUser;
use App\Models\Api\LineApiUserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class LineApiUserController extends Controller
{
    public function index($channel_name) 
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        $data   =   array(
            "channel"               =>  $channel,
            "line_api_user_groups"  =>  LineApiUserGroup::whereChannelName($channel_name)->get(),
            "line_api_users"        =>  LineApiUser::whereChannelName($channel_name)->get()->groupBy("follow"),
            "followers"             =>  $channel->get_followers(),
            "demographic"           =>  $channel->get_demographic($channel_name),
        );
        return view("admin.api.line.user.index", $data);
    }

    public function create($channel_name) 
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view("admin.api.line.user.create", $data);
    }


    public function store(Request $request,$channel_name)
    {
        $line_user_id   =   $request->get("line_user_id");
        if(!$line_user_id){
            $anonymous  =   "anonymous" . strtolower(Str::random(24));
            while(LineApiUser::whereChannelName($channel_name)->whereLineUserId($anonymous)->exists()){
                $anonymous  =   "anonymous" . strtolower(Str::random(24));
            }
            $line_user_id   =   $anonymous;
        }
        if(LineApiUser::whereChannelName($channel_name)->whereLineUserId($line_user_id)->doesntExist()){
            $line_api_user  =   LineApiUser::Create(array(
                "channel_name"      =>  $channel_name,
                "line_user_id"      =>  $line_user_id,
                "name_to_identify"  =>  $request->get("name_to_identify"),
                "registed_name"     =>  $request->get("registed_name"),
                "honorific"         =>  $request->get("honorific"),
                "memo"              =>  $request->get("memo"),
            ));
            $line_api_user->get_present_profile();
            return redirect("/api/line/$channel_name/user/$line_api_user->id");            
        }else{
            return back()->withInput();
        }

    }


    public function show($channel_name, $id)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "line_api_user" =>  LineApiUser::whereChannelName($channel_name)->whereId($id)->first(),
        );
        return view("admin.api.line.user.show", $data);
    }

    public function edit($channel_name, $id) 
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "line_api_user_id"  =>  $id,
            "line_api_user"     =>  LineApiUser::whereChannelName($channel_name)->whereId($id)->first(),
        );
        return view("admin.api.line.user.create", $data);
    }

    public function update(Request $request,$channel_name, $id) 
    {
        $line_api_user  =   LineApiUser::whereChannelName($channel_name)->whereId($id)->first();
        if($line_api_user){
            $line_user_id   =   $request->get("line_user_id");
            if($line_api_user->line_user_id == $line_user_id){
            } else {
                if(!$line_user_id){
                    $anonymous  =   "anonymous" . strtolower(Str::random(24));
                    while(LineApiUser::whereChannelName($channel_name)->whereLineUserId($anonymous)->exists()){
                        $anonymous  =   "anonymous" . strtolower(Str::random(24));
                    }
                    $line_user_id   =   $anonymous;
                }    
                if(LineApiUser::whereChannelName($channel_name)->whereLineUserId($line_user_id)->doesntExist()){
                    $line_api_user->line_user_id        =   $line_user_id;
                } else {
                    return back()->withInput();
                }
            }
            $line_api_user->name_to_identify    =   $request->get("name_to_identify");
            $line_api_user->registed_name       =   $request->get("registed_name");
            $line_api_user->honorific           =   $request->get("honorific");
            $line_api_user->memo                =   $request->get("memo");
            $line_api_user->save();

            $line_api_user->get_present_profile();
            return redirect("/api/line/$channel_name/user/$id");
        } else {
            return back()->withInput();
        }
    }

    public function info($channel_name, $id = null)
    {
        $channel    =   LineApiChannel::whereChannelName($channel_name)->first();
        if($channel){
            if($id){
                $line_api_user  =   $channel->users->where("id",$id)->first();
                if($line_api_user){
                    $line_api_user->get_present_profile();
                }
            }else{
                foreach($channel->users as $line_api_user){
                    $line_api_user->get_present_profile();
                }
            }
        }
        return redirect("/api/line/$channel_name/user");
    }

    public function import(Request $request, $channel_name)
    {
        $csv    =   $request->file("csv");
        $stream =   fopen($csv->getPathname(),"r");
        $users  =   array();
        while(($user = fgetcsv($stream))){
            $users[] =   $user;
        }
        fclose($stream);
        $headers    =   array_shift($users);
        foreach($users as $user){
            if(LineApiUser::whereChannelName($channel_name)->whereLineUserId($user[array_search("line_user_id",$headers)])->doesntExist()){
                $line_api_user  =   LineApiUser::Create(array(
                    "channel_name"      =>  $channel_name,
                    "line_user_id"      =>  array_search("line_user_id",$headers) !== false         ?   $user[array_search("line_user_id",$headers)]        :   null,
                    "registed_name"     =>  array_search("registed_name",$headers) !== false        ?   $user[array_search("registed_name",$headers)]       :   null,
                    "name_to_identify"  =>  array_search("name_to_identify",$headers) !== false     ?   $user[array_search("name_to_identify",$headers)]    :   null,
                    "honorific"         =>  array_search("honorific",$headers) !== false            ?   $user[array_search("honorific",$headers)]           :   null,
                    "memo"              =>  array_search("memo",$headers) !== false                 ?   $user[array_search("memo",$headers)]                :   null,
                ));
                $line_api_user->get_present_profile();
            }
        }
        return redirect("/api/line/$channel_name/user");
    }


    public function export($channel_name)
    {
        $line_api_users =   LineApiUser::whereChannelName($channel_name)->get();

        $stream     =   fopen("php://output","w");
        $columns    =   Schema::getColumnListing((new LineApiUser())->getTable());
        fputcsv($stream,$columns);
        $data   =   array();
        foreach($line_api_users as $line_api_user){
            $data   =   array_map(fn($column)=>$line_api_user[$column],$columns);
            fputcsv($stream,$data);
        }
        fclose($stream);

        $name       =   $channel_name. "_users_" . date("YmdHis") . ".csv";
        $headers    =   array(
            "Content-Type"  =>  "text/csv",
        );

        return response()->streamDownload(fn()=>fpassthru($stream),$name,$headers);
    }

}
