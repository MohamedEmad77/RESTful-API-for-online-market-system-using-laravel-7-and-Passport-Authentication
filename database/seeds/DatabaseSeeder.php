<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use App\Seller;
use App\Buyer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // empty tables first

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();

        $userQuantity = 1000;
        $categoriesQuantity = 30;
        $productQuantity = 1000;
        $transactionQuantity = 1000;

        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function($product){
                // bring random number of categories(1 to 5) then take their id
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $product->categories()->attach($categories);
            
        });
        factory(Transaction::class, $transactionQuantity)->create();

    }
}
