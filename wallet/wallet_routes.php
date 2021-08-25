<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Wallet\controller\AuthRegisterController;
use Wallet\controller\AuthLoginController;
use Wallet\controller\AuthLogoutController;
use Wallet\controller\Api\V1\DepositController;
use Wallet\controller\Api\V1\WithdrawController;
use Wallet\controller\Api\V1\WalletController;
use Wallet\controller\Api\V1\TransactionController;


Route::prefix('v1')->group(function () {

    #region Auth
    Route::post('/register', [AuthRegisterController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthLoginController::class, 'login'])->name('api.login');
    Route::get('/logout', [AuthLogoutController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');
    #end region

    #region WalletUser
    Route::post('/wallet/deposit', [DepositController::class, 'deposit'])->name('wallet.deposit')->middleware('auth:sanctum');
    Route::post('/wallet/withdraw', [WithdrawController::class, 'withdraw'])->name('wallet.withdraw')->middleware('auth:sanctum');
    Route::get('/wallet/user', [WalletController::class, 'wallet'])->name('wallet.wallet')->middleware('auth:sanctum');
    Route::get('/wallet/transaction', [TransactionController::class, 'transaction'])->name('wallet.transaction')->middleware('auth:sanctum');

    #end region






});
