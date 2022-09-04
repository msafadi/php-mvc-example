<?php

namespace Controllers;

use Models\Transaction;
use View;

class TransactionsController extends Controller
{

    protected $model;

    protected function getModel()
    {
        if (!$this->model) {
            global $db;
            $this->model = new Transaction($db);
        }
        return $this->model;
    }

    public function index()
    {
        $model = $this->getModel();

        $this->view('transactions/index', [
            'transactions' => $model->fetch(),
        ]);
    }

    public function create()
    {
        if ($_POST) {
            $model = $this->getModel();
            $model->create([
                'amount' => $_POST['amount'],
                'description' => $_POST['description'],
                'tag_id' => $_POST['tag_id'],
                'user_id' => 1
            ]);

            $this->flashMessage('success', 'Transaction created!');
            $this->redirect('index.php?controller=transactions&action=index');
        }

        $this->view('transactions/create');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        if ( !$id || !($transaction = $this->getModel()->find($id)) ) {
            $this->redirect('index.php?controller=transactions&action=index');
        }

        if ($_POST) {
            $data = [
                'amount' => $_POST['amount'],
                'description' => $_POST['description'],
                'tag_id' => $_POST['tag_id'],
            ];
            $this->getModel()->update($data, $id);

            $this->flashMessage('success', 'Transaction updated!');
            $this->redirect('index.php?controller=transactions&action=index');
        }

        $this->view('transactions/edit', compact('id', 'transaction'));
    }
}
