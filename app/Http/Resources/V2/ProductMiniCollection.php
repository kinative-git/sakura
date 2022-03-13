<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductMiniCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                if($data->discount_type == 'percent'){
                    $discount_percent = round( $data->discount);
                }
                elseif($data->discount_type == 'amount'){

                    $discount_percent = round( $data->discount*100/homeBasePrice($data));
                }
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'thumbnail_image' => api_asset($data->thumbnail_img),
                    'has_discount'=>(double) $data->discount!=0?true:false,
                    'discount' => (double) $discount_percent,
                    'discount_type' => $data->discount_type,
                    'current_price'=>home_discounted_base_price($data),
                    'base_price' => format_price(homeBasePrice($data)) ,
                    'rating' => (double) $data->rating,
                    'sales' => (integer) $data->num_of_sale,
                    'links' => [
                        'details' => route('products.show', $data->id),
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
