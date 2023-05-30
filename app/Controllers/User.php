<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $userModel = new UserModel();
        $data = $userModel->orderBy('user_id', 'DESC')->findAll();

        return view('list', [
            'page_title' => 'User List',
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('add_edit', [
            'page_title' => 'Add User'
        ]);
    }

    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email_id'  => $this->request->getVar('email'),
            'mobile_no'  => $this->request->getVar('mobile'),
            'password' => $this->request->getVar('password'),
        ];
        try{
            $userModel->insert($data);
            $this->session->setFlashdata('success_msg', 'User has been added successfully.');
            return $this->response->redirect(site_url('/'));
        }catch(Exception $e){
            $this->session->setFlashdata('error_msg', 'Failed to add the user. Please try again.');
            return $this->response->redirect(site_url('/'));
        }
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data = $userModel->where('user_id', $id)->first();
        return view('add_edit', [
            'page_title' => 'Edit User', 
            'user' => $data
        ]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $id = $this->request->getVar('user_id');
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email_id'  => $this->request->getVar('email'),
            'mobile_no'  => $this->request->getVar('mobile'),
            'password' => $this->request->getVar('password'),
        ];
        try{
            $userModel->update($id, $data);
            $this->session->setFlashdata('success_msg', 'User has been updated successfully.');
            return $this->response->redirect(site_url('/'));
        } catch(\Exception $e){
            $this->session->setFlashdata('error_msg', 'Failed to update the user. Please try again.');
            return $this->response->redirect(site_url('/'));
        }
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->where('user_id', $id)->delete($id);
        $this->session->setFlashdata('success_msg', 'User has been deleted successfully.');
        return $this->response->redirect(site_url('/'));
    }

    public function changeStatus()
    {
        $user_id = $this->request->getVar('user_id');
        $newStatus = $this->request->getVar('status') == '1' ? '0' : '1';

        $userModel = new UserModel();
        $input_list = [
            'status' => $newStatus,
        ];
        return $userModel->update($user_id, $input_list);
    }
}