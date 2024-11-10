<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class BlogController extends ResourceController
{
    protected $modelName = '\App\Models\BlogModel'; // Specify the model
    protected $format = 'json'; // Specify the response format
    // Tambahkan konstruktor

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();

        $response = [
            'message' => 'success banget',
            'blogs' => $data,
        ];
        return $this->respond($response, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $blog = $this->model->find($id);
        if (!$blog) {
            return $this->failNotFound('Blog not found');
        }
        return $this->respond($blog);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
    {
        // This method can be used to return a form for creating a new resource
        return $this->respond(['message' => 'Provide data to create a new blog'], 200);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();
        if ($this->model->insert($data)) {
            return $this->respondCreated(['id' => $this->model->insertID()]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        // This method can be used to return a form for editing an existing resource
        return $this->respond(['message' => 'Provide data to update the blog'], 200);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respond(['message' => 'Blog updated successfully']);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Blog deleted successfully']);
        }
        return $this->failNotFound('Blog not found');
    }
}
