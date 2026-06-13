<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create transaction_details table
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });

        // 2. Modify transactions table
        Schema::table('transactions', function (Blueprint $table) {
            // Drop foreign key to product_id first
            $table->dropForeign(['product_id']);
            
            // Make product_id nullable
            $table->unsignedBigInteger('product_id')->nullable()->change();
            
            // Re-add constraint with nullOnDelete
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            
            // Make quantity nullable
            $table->integer('quantity')->nullable()->change();
            
            // Add subtotal
            $table->decimal('subtotal', 15, 2)->nullable()->after('quantity');
        });

        // 3. Migrate existing transactions to transaction_details
        $transactions = DB::table('transactions')->get();
        foreach ($transactions as $trx) {
            if ($trx->product_id && $trx->quantity) {
                $product = DB::table('products')->where('id', $trx->product_id)->first();
                $price = $product ? $product->price : 0;
                $cost_price = $product ? $product->cost_price : 0;
                
                // insert detail
                DB::table('transaction_details')->insert([
                    'transaction_id' => $trx->id,
                    'product_id' => $trx->product_id,
                    'quantity' => $trx->quantity,
                    'price' => $price,
                    'cost_price' => $cost_price,
                    'subtotal' => $price * $trx->quantity,
                    'created_at' => $trx->created_at,
                    'updated_at' => $trx->updated_at,
                ]);

                // update transactions subtotal
                DB::table('transactions')->where('id', $trx->id)->update([
                    'subtotal' => $price * $trx->quantity,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('subtotal');
            
            // Restore product_id and quantity to not nullable
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->integer('quantity')->nullable(false)->change();
        });
    }
};
