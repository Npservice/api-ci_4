<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Uji extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        $model = new BarangModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
}
