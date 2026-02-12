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
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        
        // Parent ID: Cho phép null (nếu là danh mục gốc)
        $table->unsignedBigInteger('parent_id')->nullable();
        $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');

        $table->boolean('is_active')->default(1);
        $table->boolean('is_delete')->default(0); // Xóa mềm thủ công
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
