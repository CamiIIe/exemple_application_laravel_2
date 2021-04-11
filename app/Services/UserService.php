<?php


namespace App\Services;


use App\Exceptions\CanAlreadyExistException;
use App\Exceptions\CanCreateUserException;
use App\Exceptions\CanUpdateUserException;
use App\Exceptions\UserNotExistException;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService implements UserInterface
{

    public function findAll()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function findById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $e) {
            throw new UserNotExistException($id);
        }
    }

    public function create(Request $request)
    {
        $email = $request->get('email');
        if ($this->userExist($request->get('email'))) {
            throw new CanAlreadyExistException($request->get('email'));
        }

        try {
            $user = User::create([
                    'name'=>$request->get('name'),
                    'email'=>$request->get('email'),
                    'password'=>Hash::make('password'),
            ]);

            Address::create([
                'street'=> $request->get('street'),
                'city'=> $request->get('city'),
                'postcode'=> $request->get('postcode'),
                'country'=> $request->get('country'),
                'user_id'=> $user->id
            ]);

            return $user;

        } catch (\Exception $e) {
            throw new CanCreateUserException($request->get('name'));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->findById($id);
            $user->name = $request->get('name');

            $address = $user->address;
            $address->street = $request->get('street');
            $address->city = $request->get('city');
            $address->postcode = $request->get('postcode');
            $address->country = $request->get('country');

            $address->save();
            $user->save();

            return $user;

        } catch (\Exception $e) {
            throw new CanUpdateUserException($id);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->findById($id);
            $user->delete();

            return $user;
        } catch (UserNotExistException $e) {
            throw new UserNotExistException($id);
        }
    }

    private function userExist($email): bool {
        return User::where('email', '=', $email)->first() != null;
    }
}
