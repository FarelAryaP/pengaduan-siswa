<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id();

            // Pengaduan yang dibalas
            $table->unsignedBigInteger('pengaduan_id');
            $table->foreign('pengaduan_id')
                  ->references('id')->on('pengaduan')
                  ->onDelete('cascade');

            // Pengirim pesan (bisa petugas maupun user)
            $table->unsignedBigInteger('pengirim_id');
            $table->foreign('pengirim_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            // Isi pesan
            $table->text('isi');

            // Role pengirim agar mudah dibedakan di view ('petugas' | 'user')
            $table->string('role_pengirim'); // 'petugas' | 'user'

            // Apakah sudah dibaca oleh penerima (user)
            $table->boolean('dibaca')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};