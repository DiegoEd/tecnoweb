<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;
use App\Product;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    ##Producto
    ##['name', 'price', 'stock','productcategory_id'];

    ##Categorias
    ##['name'];
    public function run()
    {
       $productocategoria1 = new ProductCategory;
       $productocategoria1->name = 'Hogar';
       $productocategoria1->save();

       $producto1 = new Product;
       $producto1->name = 'MuebleTv';
       $producto1->price = 1548.98;
       $producto1->stock = 19;
       $producto1->productcategory_id = $productocategoria1->id;
       $producto1->save();

       $producto2 = new Product;
       $producto2->name = 'SofaCuero';
       $producto2->price = 5642.76;
       $producto2->stock = 13;
       $producto2->productcategory_id = $productocategoria1->id;
       $producto2->save();

       $producto3 = new Product;
       $producto3->name = 'SillaCocina';
       $producto3->price = 452.50;
       $producto3->stock = 26;
       $producto3->productcategory_id = $productocategoria1->id;

       $productocategoria2 = new ProductCategory;
       $productocategoria2->name = 'Oficina';
       $productocategoria2->save();


       $producto4 = new Product;
       $producto4->name = 'Escritorio1';
       $producto4->price = 2185.98;
       $producto4->stock = 27;
       $producto4->productcategory_id = $productocategoria2->id;
       $producto4->save();

       $producto5 = new Product;
       $producto5->name = 'Librero';
       $producto5->price = 1642.76;
       $producto5->stock = 34;
       $producto5->productcategory_id = $productocategoria2->id;
       $producto5->save();

       $producto6 = new Product;
       $producto6->name = 'SillonGerencial';
       $producto6->price = 2785.76;
       $producto6->stock = 42;
       $producto6->productcategory_id = $productocategoria2->id;
       $producto6->save();

       $productocategoria3 = new ProductCategory;
       $productocategoria3->name = 'Hogar-Exterior';
       $productocategoria3->save();

       $producto7 = new Product;
       $producto7->name = 'Mesa redonda';
       $producto7->price = 1285.76;
       $producto7->stock = 23;
       $producto7->productcategory_id = $productocategoria3->id;
       $producto7->save();

       $producto8 = new Product;
       $producto8->name = 'tocos para mesa';
       $producto8->price = 785.76;
       $producto8->stock = 40;
       $producto8->productcategory_id = $productocategoria3->id;
       $producto8->save();

       $productocategoria4 = new ProductCategory;
       $productocategoria4->name = 'Empresarial';
       $productocategoria4->save();


       $producto9 = new Product;
       $producto9->name = 'Mueble para recepcion';
       $producto9->price = 2785.76;
       $producto9->stock = 22;
       $producto9->productcategory_id = $productocategoria4->id;
       $producto9->save();

       $producto10 = new Product;
       $producto10->name = 'Sillones de espera doble';
       $producto10->price = 3785.76;
       $producto10->stock = 19;
       $producto10->productcategory_id = $productocategoria4->id;
       $producto10->save();

       $producto11 = new Product;
       $producto11->name = 'Sillon-espera 5';
       $producto11->price = 4785.76;
       $producto11->stock = 12;
       $producto11->productcategory_id = $productocategoria4->id;
       $producto11->save();

       $producto12 = new Product;
       $producto12->name = 'Mesa-Revista';
       $producto12->price = 1185.76;
       $producto12->stock = 34;
       $producto12->productcategory_id = $productocategoria4->id;
       $producto12->save();


    }
}
