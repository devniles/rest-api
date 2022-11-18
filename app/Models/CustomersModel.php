<?php 
namespace App\Models;
use CodeIgniter\Model;
class EmployeeModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email'];
}