<?php

namespace src\Services;
use src\Repositories\DriverRepository;
class DriverService
{
    public function __construct(private DriverRepository $driverRepository) {}

    public function all(){
        return $this->driverRepository->all();
    }

    public function find($id){
        return $this->driverRepository->find($id);
    }
    public function create($data){
        return $this->driverRepository->create($data);
    }
    public function update($data, $id){
        return $this->driverRepository->update($data, $id);
    }
    public function delete($id){
        return $this->driverRepository->delete($id);
    }
}
