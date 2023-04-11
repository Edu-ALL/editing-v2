<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesManagingToTblEssayEditors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_essay_editors', function (Blueprint $table) {
            $table->text('notes_managing')->nullable()->after('notes_editors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_essay_editors', function (Blueprint $table) {
            $table->dropColumn('notes_managing');
        });
    }
}
