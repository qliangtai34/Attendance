<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * サービス登録
     */
    public function register()
    {
        // 新規登録処理
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }

    /**
     * サービス起動
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | メール認証完了画面
        |--------------------------------------------------------------------------
        */
        Fortify::verifyEmailView(function () {
            return view('auth.verify-success');
        });

        /*
        |--------------------------------------------------------------------------
        | View 設定
        |--------------------------------------------------------------------------
        */
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::loginView(fn () => view('auth.login'));

        /*
        |--------------------------------------------------------------------------
        | ログイン認証処理（メール未認証はログイン不可）
        |--------------------------------------------------------------------------
        */
        Fortify::authenticateUsing(function (Request $request) {

            // ❌ 認証失敗
            if (! Auth::attempt(
                $request->only('email', 'password'),
                $request->boolean('remember')
            )) {
                throw ValidationException::withMessages([
                    'email' => 'ログイン情報が登録されていません',
                ]);
            }

            $user = Auth::user();

            // ❌ メール未認証
            if (! $user->hasVerifiedEmail()) {
                Auth::logout();

                throw ValidationException::withMessages([
                    'email' => 'メール認証が完了していません。認証メールをご確認ください。',
                ]);
            }

            // ✅ 認証成功
            return $user;
        });
    }
}
