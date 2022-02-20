<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;

class Aggregations
{
    public function __invoke($root, array $args)
    {
        $query = DB::table('product_value')
            ->select('product_value.value_id as id', 'values.name', DB::raw('count(*) as count'))
            ->join('values', 'values.id', '=', 'product_value.value_id')
            ->join('products', 'products.id', '=', 'product_value.product_id')
            ->groupBy('product_value.value_id');

        if ($values = @$args['filter']['values']) {
            $query->whereIn('product_value.value_id', $values);
        }

        if ($categories = @$args['filter']['categories']) {
            $query->whereIn('products.category_id', $categories);
        }

        return $query->get();
    }
}
