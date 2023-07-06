<?php

namespace App\Http\Controllers\Modules\File;

class Modules
{
    const modulesList = [
        ['name' => 'Users', 'namespace' => 'App\\Http\\Controllers\\Users', 'status' => 'Active' , "nickname" => "Users", "default_permissions" => ["List", "View", "Create", "Update", "Delete"], "type" => "Core"],
        ['name' => 'Clients', 'namespace' => 'App\\Http\\Controllers\\Clients', 'status' => 'Active' , "nickname" => "Clients", "default_permissions" => ["List", "View", "Create", "Update", "Delete"], "type" => "Core"],
        ['name' => 'Products', 'namespace' => 'App\\Http\\Controllers\\Products', 'status' => 'Active' , "nickname" => "Products", "default_permissions" => ["List", "View", "Create", "Update", "Delete"], "type" => "Core"],
        ['name' => 'Invioce Products', 'namespace' => 'App\\Http\\Controllers\\Invoices', 'status' => 'Active' , "nickname" => "Invoice", "default_permissions" => ["List", "View", "Create", "Update", "Delete"], "type" => "Core"],
        ['name' => 'Invoices', 'namespace' => 'App\\Http\\Controllers\\Invoices', 'status' => 'Active' , "nickname" => "Invoices", "default_permissions" => ["List", "View", "Create", "Update", "Delete"], "type" => "Core"],
    ];
}
