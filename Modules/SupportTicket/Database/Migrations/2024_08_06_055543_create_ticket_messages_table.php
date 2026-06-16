<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('support_ticket_id');
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->text('message');
            $table->string('message_from')->comment('user, admin');
            $table->string('seen_by_admin')->default('no');
            $table->string('seen_by_user')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_messages');
    }
};
