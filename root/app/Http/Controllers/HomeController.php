<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }

        public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //同じタグがあるか確認
        $exist_tag = Tag::where("name",$data["tag"])->where("user_id",$data["user_id"])->first();
        if( empty($exist_tag["id"])){
            //先にタグをインサート
            $tag_id = Tag::insertGetId(["name" => $data["tag"], "user_id" => $data["user_id"]]);
        } else {
            $tag_id = $exist_tag["id"];
        }

        //タグのIDか判明する
        //タグIDをmemosテーブルに入れてあげる
        $memo_id = Memo::insertGetId([
            "content" => $data["content"],
            "user_id" => $data["user_id"],
            "tag_id" => $tag_id,
            "status" => 1,
        ]);

        //リダイレクト処理
        return redirect()->route("home");
    }

    public function edit($id){
        $user = \Auth::user();
        //firstは条件のものを1行取る
        $memo = Memo::where("status",1)->where("id",$id)->where("user_id",$user["id"])->first();
        // dd($memo);

        return view("edit",compact("memo"));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        //どこの分
        Memo::where("id",$id)->update(["content" => $inputs["content"], "tag_id" => $inputs["tag_id"]]);

        //リダイレクト処理
        return redirect()->route("home");
    }

        public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        //論理削除なので
        Memo::where("id",$id)->update(["status" => 2 ]);
        //物理削除は
        // Memo::where("id",$id)->delete();
        //リダイレクト処理
        return redirect()->route("home")->with("success", "メモの削除が完了しました！");
    }
}
