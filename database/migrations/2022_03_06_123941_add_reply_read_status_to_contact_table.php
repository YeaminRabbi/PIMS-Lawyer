<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplyReadStatusToContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->integer('read')->after('message')->default(0);
            $table->integer('reply')->after('read')->default(0);
            $table->text('reply_content')->after('reply')->nullable();
            $table->string('reply_content_date')->after('reply_content')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('read');
            $table->dropColumn('reply');
            $table->dropColumn('reply_content');
            $table->dropColumn('reply_content_date');


        });
    }
}
