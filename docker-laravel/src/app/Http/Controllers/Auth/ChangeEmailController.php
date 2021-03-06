<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\EmailReset;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChangeEmailController extends Controller
{
  public function __invoke(ChangeEmailRequest $request)
  {
    $new_email = $request->new_email();

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
      $email_reset = EmailReset::create($param);

      DB::commit();

      $email_reset->sendEmailResetNotification($token);

      return redirect('/')->with('my_status', '確認メールを送信しました。');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect('/')->with('my_status', 'メール更新に失敗しました。');
    }
  }
}
