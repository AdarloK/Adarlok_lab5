<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function before_action()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->call->model('ProductModel');
    }

    public function index()
    {
        try {
            $products = ProductModel::order_by('created_at', 'DESC');
        } catch (Throwable $exception) {
            http_response_code(500);
            $this->call->view('products/index', [
                'products' => [],
                'message' => 'Database error: ' . $exception->getMessage(),
            ]);
            return;
        }

        $this->call->view('products/index', [
            'products' => $products,
            'message' => $_SESSION['product_message'] ?? null,
        ]);
        unset($_SESSION['product_message']);
    }

    public function create()
    {
        $this->call->view('products/form', [
            'title' => 'Add product',
            'action' => site_url('products/create'),
            'product' => [],
            'submit_label' => 'Create product',
        ]);
    }

    public function store()
    {
        $data = $this->validated_input();
        if ($data === false) {
            return;
        }
        ProductModel::insert($data);
        $_SESSION['product_message'] = 'Product created.';
        redirect('products');
    }

    public function edit($id)
    {
        $product = ProductModel::find((int) $id);
        if (!$product) {
            show_404();
            return;
        }
        $this->call->view('products/form', [
            'title' => 'Edit product',
            'action' => site_url('products/edit/' . (int) $id),
            'product' => $product,
            'submit_label' => 'Save changes',
        ]);
    }

    public function update($id)
    {
        $data = $this->validated_input();
        if ($data === false) {
            return;
        }
        ProductModel::update((int) $id, $data);
        $_SESSION['product_message'] = 'Product updated.';
        redirect('products');
    }

    public function delete($id)
    {
        ProductModel::delete((int) $id);
        $_SESSION['product_message'] = 'Product deleted.';
        redirect('products');
    }

    private function validated_input()
    {
        $name = trim($_POST['product_name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = filter_var($_POST['price'] ?? null, FILTER_VALIDATE_FLOAT);
        $quantity = filter_var($_POST['quantity'] ?? null, FILTER_VALIDATE_INT);

        if ($name === '' || strlen($name) > 100 || $price === false || $price < 0 || $quantity === false || $quantity < 0) {
            $_SESSION['product_message'] = 'Enter a product name, a non-negative price, and a non-negative quantity.';
            redirect('products');
            return false;
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format($price, 2, '.', ''),
            'quantity' => $quantity,
        ];
    }
}
