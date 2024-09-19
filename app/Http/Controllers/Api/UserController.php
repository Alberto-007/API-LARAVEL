<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::orderBy('id', 'DESC')->get();

        return response()->json(
            [
                'status' => true,
                'users' => $users,
            ]
        );
    }

    public function show(User $user): JsonResponse
    {
        $user = User::find($user->id);

        return response()->json(
            [
                'status' => true,
                'user' => $user,
            ]
        );
    }

    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->all());

            DB::commit();

            return response()->json(
                [
                    'status' => true,
                    'user' => $user,
                    'message' => "Usuário cadastrado com sucesso!"
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                400
            );
        }
    }
    public function update(UserRequest $request, User $user): JsonResponse
    {
        DB::beginTransaction();
        try {  
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();

            return response()->json(
                [
                    'status' => true,
                    'user' => $user,
                    'message' => "Usuário atualizado com sucesso!"
                ], 200
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                400
            );
        }
    }

    public function destroy(User $user): JsonResponse
        {

            try{
                $user->delete();
                return response()->json(
                    [
                        'status' => true,
                        'user' => $user,
                        'message' => "Usuário deletado com sucesso!"
                    ],
                    200
                );
            }catch(Exception $e){
                return response()->json(
                    [
                        'status' => false,
                        'message' => $e->getMessage()
                    ],
                    400
                );
            }
    }
}
