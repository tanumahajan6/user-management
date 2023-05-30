<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';

    protected $primaryKey = 'user_id';
    
    protected $allowedFields = ['firstname', 'lastname', 'gender', 'email_id', 'mobile_no', 'password', 'status'];
}