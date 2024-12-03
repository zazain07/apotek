<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
        DROP TRIGGER IF EXISTS cannot_update_log;

        CREATE TRIGGER cannot_update_log 
        BEFORE UPDATE ON logs 
        FOR EACH ROW 
        BEGIN 
            SIGNAL SQLSTATE '45000' SET
            MESSAGE_TEXT = 'Tidak Dapat Mengubah Log';
        END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
