<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        $users = UserResource::collection(User::get());

        return $this->apiResponse($users,'تم جلب البيانات بنجاح',200);

    }

    public function show($id)
    {
        /* لو انا عملت التحويل هنا هيديني error لما ال id بتاع المستخدم ميبقاش موجود
         $user = new UserResource(User::find($id));

         */

        $user = User::find($id);

        if ($user){

            /*التحويل بيتم هنا لان في داتا رجعالي زي id,name,email*/

            return $this->apiResponse(new UserResource($user) ,'تم جلب البيانات بنجاح',200);

        }

        return $this->apiResponse(null,'هذا المستخدم ليس موجود في قاعده البيانات لدنيا',404);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_name'=> 'required|unique:users',
            'email'=> 'required|email|unique:users',
            'date_of_birth'=> 'required',
            'phone_number'=> 'required|unique:users',
            'password'=> 'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $user = User::create(
            $request->all()
        );

        if ($user){
            return $this->apiResponse(new UserResource($user) ,'تم حفظ بياناتك بنجاح',201);
        }else{
            return $this->apiResponse(null,'لم يتم حفظ بياناتك برجاء التسجيل مرة أخري',400);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'user_name'=> 'required|string|between:2,100',
            'email'=> 'required|email|unique:users',
            'date_of_birth'=> 'required',
            'phone_number'=> 'required|unique:users',
            'password'=> 'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $user = User::find($id);

        if (!$user){
            return $this->apiResponse(null,'البيانات غير موجوده في قاعدة البيانات الخاصة بنا',404);
        }

        $user->update(
            $request->all()
        );

        if ($user){

            return $this->apiResponse(new UserResource($user) ,'تم تحديث بياناتك بنجاح',201);
        }

    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user){

            return $this->apiResponse(null,'البيانات غير موجوده في قاعدة البيانات الخاصة بنا',404);
        }

        $user->delete($id);

        if ($user){

            return $this->apiResponse(null ,'تم حذف بياناتك بنجاح',201);
        }
    }


}
