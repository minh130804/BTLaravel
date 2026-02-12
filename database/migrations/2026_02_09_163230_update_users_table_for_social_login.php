<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Kiểm tra xem cột google_id đã có chưa, nếu chưa thì mới thêm
        if (!Schema::hasColumn('users', 'google_id')) {
            $table->string('google_id')->nullable();
        }
        
        // Kiểm tra cột facebook_id
        if (!Schema::hasColumn('users', 'facebook_id')) {
            $table->string('facebook_id')->nullable();
        }

        
        $table->string('password')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
