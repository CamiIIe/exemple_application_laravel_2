<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface UserInterface
{
    public function findAll();
    public function findById($id);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete($id);
}
