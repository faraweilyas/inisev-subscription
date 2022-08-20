<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_subscribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('ubsubscribed_at')->nullable();
            $table->timestamps();

            $table->unique(['website_id', 'subscriber_id']);

            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onDelete('cascade');

            $table->foreign('subscriber_id')
                ->references('id')
                ->on('subscribers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_subscribers');
    }
}
