<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       DB::connection()->setSchemaGrammar(new class extends MySqlGrammar {
            protected function compileColumnListing()
            {
                return 'select column_name as `name`, data_type as `type_name`, column_type as `type`, 
                        collation_name as `collation`, is_nullable as `nullable`, 
                        column_default as `default`, column_comment as `comment`, 
                        extra as `extra` 
                        from information_schema.columns 
                        where table_schema = ? and table_name = ? 
                        order by ordinal_position asc';
            }
        });
    }
}
