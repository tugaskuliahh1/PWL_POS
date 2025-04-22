<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id('supplier_id');
            $table->string('supplier_nama');
            $table->string('supplier_kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_supplier');
    }
};
