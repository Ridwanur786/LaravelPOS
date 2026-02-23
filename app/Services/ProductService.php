<?php

namespace App\Services;

use App\Models\Product;
use App\Rules\UniqueProductCode;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;


class ProductService {

public function store( array $data): Product
{
    $productCode = $this->generateUniqueCode();
    $barCode = $this->generateBarcode($productCode);


    return Product::create(
        [
            'product_name' => $data['product_name'],
            'description' => $data['description'],
            'brand' => $data['brand'] ??  null,
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'alert_stock' => $data['alert_stock'] ?? 100,
            'product_code' => $productCode,
            'barcode' => $barCode,
          
        ]);

}

    public function update(Product $product ,array $data)
    {
        $product->update($data);
        return $product;
    }


    private function generateUniqueCode(): string
    {

    $rule = new UniqueProductCode();
        do{
            $code = 'PRD-' . strtoupper(Str::random(8));
        }while( ! $rule->passes('product_code', $code));


        return $code;

    } 


    private function generateBarcode(string $code):string
    {
        $generator = new BarcodeGeneratorHTML();
        return $generator->getBarcode(
            $code,
            $generator::TYPE_CODE_128,
            1,
            40
        );
    }
}