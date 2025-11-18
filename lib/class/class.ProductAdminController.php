<?php

class ProductAdminController
{
    /**
     * @var Product
     */
    protected $productModel;

    /**
     * @var Database
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db           = $db;
        $this->productModel = new Product($db);
    }

    /**
     * Tạo mới sản phẩm (wrapper cho Product::createProduct).
     *
     * @param array $data
     * @return int|bool
     */
    public function create(array $data)
    {
        return $this->productModel->createProduct($data);
    }

    /**
     * Cập nhật sản phẩm theo ID.
     *
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->productModel->updateProduct($id, $data);
    }

    /**
     * Xoá sản phẩm theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->productModel->deleteProduct($id);
    }
}


