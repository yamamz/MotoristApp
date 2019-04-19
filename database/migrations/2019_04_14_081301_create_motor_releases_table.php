<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 
  
    
        Schema::create('motor_releases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->float('down_payment');
            $table->integer('motor_id');
            $table->float('monthly_due')->nullable();
            $table->date('date_recieved')->nullable();
            $table->string('due_date')->nullable();
            $table->boolean('is_loan')->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
           // $table->foreign('member_loan_id')->references('id')->on('member_loans')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motor_releases');
    }
}
