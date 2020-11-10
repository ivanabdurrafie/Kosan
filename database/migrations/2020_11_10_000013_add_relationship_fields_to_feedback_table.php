<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFeedbackTable extends Migration
{
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_2560549')->references('id')->on('users');
            $table->unsignedInteger('transaction_id');
            $table->foreign('transaction_id', 'transaction_fk_2560550')->references('id')->on('transactions');
        });
    }
}