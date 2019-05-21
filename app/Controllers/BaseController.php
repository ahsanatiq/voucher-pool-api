<?php
namespace App\Controllers;

use Illuminate\Support\Collection as LaravelCollection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

abstract class BaseController
{
    public function toFractalResponse($data, $transformer)
    {
        $fractal = new Manager();
        if ($data instanceof LaravelCollection) {
            $resource = new Collection($data, $transformer);
        } else {
            $resource = new Item($data, $transformer);
        }
        return $fractal->createData($resource)->toArray();
    }
}
