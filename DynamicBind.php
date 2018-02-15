<?php

namespace App;

trait BindsDynamically
{
    protected $connection = null;
    protected $table = null;

    public function bind(string $connection, string $table)
    {
        $this->setConnection($connection);
        $this->setTable($table);
    }

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);

        return $model;
    }

    // $product = new Product;
    // $product->getTable();
    // $product->bind('connection', 'oooops');
    // $product->get();
    // $product->first();
}
