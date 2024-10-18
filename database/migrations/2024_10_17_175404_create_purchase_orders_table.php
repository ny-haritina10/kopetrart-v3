<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        // Create the purchase_orders table
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->date('order_date');
            $table->string('buyer_name');
            $table->text('buyer_address');
            $table->string('buyer_phone');
            $table->string('buyer_email');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });

        // Create the purchase_order_items table
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign key reference to purchase_orders
            $table->foreignId('id_purchase_order')
                  ->constrained('purchase_orders')
                  ->onDelete('cascade');  // Ensure correct foreign key constraint
            
            // Foreign key reference to products
            $table->foreignId('id_product')
                  ->constrained('product'); // Referencing the products table

            $table->string('description');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
    }
}