<?php

namespace Src\Controllers;

use src\Services\DriverService;

class DriverController
{
    public $data;
    public function __construct(
        private DriverService $driverService

    ){
        $this->data = $_POST;
    }

    public function index(){
        return $this->driverService->all();
    }

    public function create(){
        $errors = [];

        if (strlen($this->data['name']) < 3){
           $errors['name'] = 'Name must be at least 3 characters long';
        }
        if (strlen($this->data['surname']) < 3){
             $errors['surname'] = 'Surname must be at least 3 characters long';
        }
        return $this->driverService->create(
            ['name' => $this->data['name'], 'surname' => $this->data['surname'], 'age' => $this->data['age'], 'number' => $this->data['number']]
        );
    }

    public function delete($id){
        return $this->driverService->delete($id);
    }

    public function update($id){
        return $this->driverService->update([
            'name' => $this->data['name'],
            'surname' => $this->data['surname'],
            'age' => $this->data['age'],
            'number' => $this->data['number']
        ], $id);
    }

    public function find($id){
        return $this->driverService->find($id);
    }


}
