<?php
namespace App\Http\Controllers;

use App\Enums\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){
        $users = User::all();
        $categories = Category::cases();

        return view('users', compact('users', 'categories'));
    }
}
