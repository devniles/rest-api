<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomersModel;

class Customers extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index(){

        echo "sd";exit;
      $model = new CustomersModel();
      $data['customers'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    // create
    public function create() {
        $model = new CustomersModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Customers created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }
    // single user
    public function show($id = null){
        $model = new CustomersModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Customers found');
        }
    }
    // update
    public function update($id = null){
        $model = new CustomersModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Customers updated successfully'
          ]
      ];
      return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new CustomersModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Customers successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Customers found');
        }
    }
}