<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Mail\Thanks;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\History;
use App\Models\Acount;
use App\Models\EmailReset;
use App\Http\Requests\AcountRequest;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Console\Presets\React;

class AcountController extends Controller
{

    //アカウント情報
    public function acount(Request $request, History $history, Acount $acount)
    {
        $user = Auth::user();
        $lists = $history->getHistory($user->id);
        $acount = $acount->getAdress($user->id);

        return view('acount.acount', compact('user', 'lists', 'acount'));
    }

    //お届け先情報記入ページ移動
    public function createAdress(AcountRequest $request, Acount $acount)
    {
        $data = $request->all();
        unset($data['_token']);

        $message = $acount->createAdress($data);
        Session::flash('flash_message', $message);

        return redirect()->route('acount');
    }

    //お届け先編集ページ移動
    public function editAdress(Acount $acount)
    {
        $user_id = Auth::id();
        $adress = $acount->getAdress($user_id);

        return view('acount.edit', compact('adress'));
    }

    //お届け先編集
    public function updateAdress(Request $request, Acount $acount)
    {
        $data = $request->all();
        unset($data['_token']);

        $message = $acount->updateAdress($data);
        Session::flash('flash_message', $message);

        return redirect()->route('acount');
    }

    //お届け先編集ページ移動
    public function editAcount(Acount $acount)
    {
        $user_id = Auth::id();
        $acount = $acount->getAcount($user_id);

        return view('acount.edit', compact('acount'));
    }

    //メールアドレス変更
    public function sendChangeEmailLink(Request $request, EmailReset $emailreset)
    {
        $new_email = $request->new_email;

        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );

        // トークンをDBに保存
        DB::beginTransaction();
        try {
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            $email_reset = $emailreset->create($param);

            DB::commit();

            $email_reset->sendEmailResetNotification($token);

            return redirect()->route('reset.email')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('reset.email')->with('flash_message', 'メール更新に失敗しました。');
        }
    }

    // //メールアドレスの再設定処理
    // public function reset(Request $request, $token)
    // {
    //     $email_reset = DB::table('email_resets')->
    // }
}
