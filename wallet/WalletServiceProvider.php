<?php

namespace Wallet;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Wallet\Models\Transaction;

class WalletServiceProvider extends ServiceProvider
{

    public function register()
    {
        //for relation between User and Transactions models
        User::resolveRelationUsing('transactions', function () {
            return $this->hasMany(Transaction::class);
        });

    }

    public function boot()
    {

        //register route for wallet_routes
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('wallet/wallet_routes.php'));



        //load migrations in wallet
        $this->loadMigrationsFrom(base_path('wallet/migrations'));




    }
}
