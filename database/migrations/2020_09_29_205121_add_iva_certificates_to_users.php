<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIvaCertificatesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('iva_certificate')->default(false)->after('profile_photo_path');
            $table->string('iva_certificate_file')->nullable()->after('iva_certificate');
            $table->boolean('bartending_course')->default(false)->after('iva_certificate_file');
            $table->timestamp('bartending_course_date')->nullable()->after('bartending_course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('iva_certificate');
            $table->dropColumn('iva_certificate_file');
            $table->dropColumn('bartending_course');
            $table->dropColumn('bartending_course_date');
        });
    }
}
