<?php

/*
 * This file is part of OAuth 2.0 Laravel.
 *
 * (c) Luca Degasperi <packages@lucadegasperi.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This is the create oauth Client grants table migration class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class CreateOauthClientGrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_client_grants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id', 40);
            $table->string('grant_id', 40);
            $table->timestamps();

            $table->index('client_id');
            $table->index('grant_id');

            $table->foreign('client_id')
                  ->references('id')->on('oauth_clients')
                  ->onDelete('cascade')
                  ->onUpdate('no action');

            $table->foreign('grant_id')
                  ->references('id')->on('oauth_grants')
                  ->onDelete('cascade')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_client_grants', function (Blueprint $table) {
            $table->dropForeign('oauth_client_grants_client_id_foreign');
            $table->dropForeign('oauth_client_grants_grant_id_foreign');
        });
        Schema::drop('oauth_client_grants');
    }
}
