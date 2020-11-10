<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_2560390')->references('id')->on('users');
            $table->unsignedInteger('room_id');
            $table->foreign('room_id', 'room_fk_2560391')->references('id')->on('rooms');
        });
    }
}