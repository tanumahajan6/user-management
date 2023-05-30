<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    /**
     * Constructor for initializing the session variable throughout the class.
     */
    function __construct()
    {
        $this->session = \Config\Services::session();               #Sessions are set for flash message 
    }

    /**
     * index() is used to fetch & display the list of all the users. 
     */
    public function index()
    {
        $userModel = new UserModel();                               #Initialized the User Model object
        $data = $userModel->orderBy('user_id', 'DESC')->findAll();  #Fetching all the records from tbl_user

        return view('list', [
            'page_title' => 'User List',
            'data' => $data
        ]);                                                         #Passed the user list in response to view file
    }

    /**
     * create() renders the add/edit form for user inputs.
     */
    public function create()
    {
        return view('add_edit', [
            'page_title' => 'Add User'
        ]);                                                         #Rendering the add_edit form
    }

    /**
     * store() post method is used after submitting the add user form. 
     * This method fires an insert query to create a new user.
     */
    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email_id'  => $this->request->getVar('email'),
            'mobile_no'  => $this->request->getVar('mobile'),
            'password' => $this->request->getVar('password'),
        ];                                                          #Input list to pass in insert query
        try{                                                        
            $userModel->insert($data);                              #Insert query 
            $this->session->setFlashdata('success_msg', 'User has been added successfully.');  #To display the flash message from session, which is valid only for one request
            return $this->response->redirect(site_url('/'));
        }catch(Exception $e){                                       #Exception handling if the insertion fails
            $this->session->setFlashdata('error_msg', 'Failed to add the user. Please try again.');
            return $this->response->redirect(site_url('/'));
        }
    }

    /**
     * edit() method is used to fetch single record and display it in a prefilled form. 
     * $id parameter is required for this method to fetch the user details for that particular user_id.
     */
    public function edit($id)
    {
        $userModel = new UserModel();
        $data = $userModel->where('user_id', $id)->first();         #Fetching single user record based on the user_id
        return view('add_edit', [
            'page_title' => 'Edit User', 
            'user' => $data
        ]);
    }

    /**
     * update() method is used to retrieve the user input and execute the update query in database with the updated values.
     */
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
        ];                                                          #Input list to pass in update query
        try{
            $userModel->update($id, $data);                         #Update query
            $this->session->setFlashdata('success_msg', 'User has been updated successfully.');
            return $this->response->redirect(site_url('/'));
        } catch(\Exception $e){                                     #Exception handling in case of failure
            $this->session->setFlashdata('error_msg', 'Failed to update the user. Please try again.');
            return $this->response->redirect(site_url('/'));
        }
    }

    /**
     * delete() method deletes a single record from the tbl_user.
     * $id parameter is required to identify the user for deletion.
     */
    public function delete($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->where('user_id', $id)->delete($id);     #Query to hard delete the user record
        $this->session->setFlashdata('success_msg', 'User has been deleted successfully.');
        return $this->response->redirect(site_url('/'));
    }

    /**
     * changeStatus() is the Ajax call post method to change the status of the user from the listing page
     */
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