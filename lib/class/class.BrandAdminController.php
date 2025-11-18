<?php

class BrandAdminController
{
    /**
     * @var Brand
     */
    protected $brandModel;

    /**
     * @var Database
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db         = $db;
        $this->brandModel = new Brand($db);
    }

    public function create(array $data)
    {
        return $this->brandModel->createBrand($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->brandModel->updateBrand($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->brandModel->deleteBrand($id);
    }
}


