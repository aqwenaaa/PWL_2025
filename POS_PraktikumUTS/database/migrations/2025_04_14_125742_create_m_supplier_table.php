<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id('supplier_id'); // BIGINT UNSIGNED + Auto Increment
            $table->string('supplier_kode', 15)->unique();
            $table->string('supplier_nama', 100);
            $table->text('supplier_alamat');
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_supplier');
    }
};