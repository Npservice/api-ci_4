<?php

namespace App\Controllers;


use App\Models\BarangModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class barang extends ResourceController
{
    use ResponseTrait;
    // get all producct
    public function index()
    {
        $model = new BarangModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    // get single data
    public function show($id = null)
    {
        $model = new BarangModel();
        $data = $model->getWhere(['kd_barang' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data with id ' . $id);
        }
    }
    // create data
    public function create()
    {
        $model =  new BarangModel();
        $data = [
            'kd_barang' => $this->request->getPost('kd_barang'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
            'nm_barang' => $this->request->getPost('nm_barang'),
            'jml_barang' => $this->request->getPost('jml_barang'),
            'warna' => $this->request->getPost('warna'),
            'ukuran' => $this->request->getPost('ukuran'),
            'harga' => $this->request->getPost('harga'),
            'ket_barang' => $this->request->getPost('ket_barang')
        ];
        $model->insert($data);
        $response = [
            'status' => 201,
            'error'  => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response, 201);
    }
    // update data
    public function update($id = null)
    {
        $model = new BarangModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'jenis_barang' => $json->jenis_barang,
                'nm_barang' => $json->nm_barang,
                'jml_barang' => $json->jml_barang,
                'warna' => $json->warna,
                'ukuran' => $json->ukuran,
                'harga' => $json->harga,
                'ket_barang' => $json->ket_barang
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [

                'jenis_barang' => $input['jenis_barang'],
                'nm_barang' => $input['nm_barang'],
                'jml_barang' => $input['jml_barang'],
                'warna' => $input['warna'],
                'ukuran' => $input['ukuran'],
                'harga' => $input['harga'],
                'ket_barang' => $input['ket_barang']
            ];
            $model->update($id, $data);
            $response = [
                'status' => 201,
                'erorr' => null,
                'message' => [
                    'success' => 'Data Update'
                ]
            ];
            return $this->respondUpdated($response);
        }
    }
    // delete
    public function delete($id = null)
    {
        $model = new BarangModel;
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 201,
                'erorr' => null,
                'message' => [
                    'success' => 'Data delete'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'erorr' => null,
                'message' => [
                    'success' => 'Data Not Found'
                ]
            ];
            return $this->respondDeleted($response);
        }
    }
}
