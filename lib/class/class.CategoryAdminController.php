<?php

class CategoryAdminController
{
    /**
     * @var Category
     */
    protected $categoryModel;

    /**
     * @var Database
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db            = $db;
        $this->categoryModel = new Category($db);
    }

    public function create(array $data)
    {
        return $this->categoryModel->createCategory($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->categoryModel->updateCategory($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->categoryModel->deleteCategory($id);
    }
}


