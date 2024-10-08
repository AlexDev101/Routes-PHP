<?php

    namespace App\Controllers;

    use App\Controllers\Controller;
    use App\Models\User;

 class UserController extends Controller {

    public function index() {
        $model = new User;

        if (isset($_GET['search'])) {
            $users = $model->searchUser('name', $_GET['search'])->getOne();
        } else {
            $users = $model->getAllUsers();
        }
        
        // $users = $model->paginate(3);

        return $this->view('users.index', compact('users'));
    }

    public function create() {
        return $this->view('users.create');
    }

    public function store() {
        $data = $_POST;
        $model = new User;
        $model->createUser($data);
        return header('Location: /users');
    }

    public function show($id) {
        $model = new User;
        $user = $model->getUser($id);

        return $this->view('users.show', compact('user'));
    }

    public function edit($id) {
        $model = new User;
        $user = $model->getUser($id);

        return $this->view('users.edit', compact('user'));
    }

    public function update($id) {
        $data = $_POST;
        $model = new User;
        $model->updateUser($id, $data);
        return header("Location: /users/{$id}");
    }

    public function delete($id) {
        $model = new User();
        $model->deleteUser($id);
        return header("Location: /users");
    }
 }

?>