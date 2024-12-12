<?php

namespace App\Dao;
use App\Models\User;

class UserDao {
/**
 * Retrieve all User records from the database.
 *
 * @return \Illuminate\Database\Eloquent\Collection|User[]
 */
    function getAll() {
        return User::all();
    }

    /**
     * Retrieve a specific User record by its ID.
     *
     * @param int $id The ID of the User to retrieve.
     * @return User|null The User object if found, otherwise null.
     */
    function getById($id) {
        return User::find($id);
    }

    /**
     * Create a new User record in the database.
     *
     * @param array $data The data to create the User record with.
     * @return User The created User object.
     */
    function create($data) {
        return User::create($data);
    }

    /**
     * Update a specific User record by its ID.
     *
     * @param int $id The ID of the User to update.
     * @param array $data The data to update the User with.
     * @return User The updated User object.
     */
    function update($id, $data) {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    /**
     * Deletes a specific User record by its ID.
     *
     * @param int $id The ID of the User to delete.
     * @return User The deleted User object.
     */
    function delete($id) {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    /**
     * Attempt to log a user in with the given credentials.
     *
     * @param array $credentials The user's login credentials.
     * @return array An array containing either an error message with a 400 code if authentication fails,
     *               or a response with the JWT token if successful.
     */
    public function login($credentials)
    {

        if (! $token = auth('api')->attempt($credentials)) {
            return [ 'data' => ['error' => 'Unauthorized'], 'code' => 400];
        }
 
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User
     *
     * @return \App\Models\User
     */
    public function me()
    {
        return auth('api')->user();
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return array A response with a message
     */
    public function logout()
    {
        auth('api')->logout();
 
        return ['message' => 'Successfully logged out'];
    }

    /**
     * Refresh the current JWT token.
     *
     * @return array An array containing the user's data and a new JWT token.
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Respond with a token response array.
     *
     * @param string $token
     *
     * @return array
     */
    protected function respondWithToken($token)
    {
        $data['data'] = $this->me();
        $dataToken = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
        $data['data']['token'] = $dataToken;
        $data['code'] = 200;
        return $data;
    }
 
}