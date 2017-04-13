<?php

namespace App\Repositories;

interface BaseInterface
{
    public function all();

    public function lists($column, $key = null);

    public function paginate($limit = null, $columns = ['*']);

    public function find($id, $columns = ['*']);

    public function where($conditions, $operator = null, $value = null);

    public function whereIn($column, $value);

    public function orWhere($column, $operator = null, $value = null);

    public function create($input);

    public function firstOrCreate($input);

    public function multiCreate($input);

    public function update($id, $input);

    public function multiUpdate($column, $value, $input);

    public function delete($id);
}
