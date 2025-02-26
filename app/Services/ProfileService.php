<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService {


    public static function getData(int $id = null) {

        if(!is_null($id)) {
            return User::where('id', $id)
                ->first() ?? null;
        }

        return User::all();

    }

    public static function update(int $id, array $payload) {

        DB::beginTransaction();

        
        try {

            $data = self::getData($id);

            $user_type = $data->user_type;
            
            if($user_type == 'client') {
                $updateData = [
                    'firstname' => $payload['firstname'],
                    'lastname' => $payload['lastname'],
                    'middlename' => $payload['middlename'],
                    'address' => $payload['address'],
                    'contact_no' => $payload['contact_no'],
                    'email' => $payload['email'],
                    'isValidated' => $payload['isValidated'],
                    'contract_no' => $payload['contract_no'],
                    'contract_date' => $payload['contract_date'],
                    'residence_type' => $payload['residence_type'],
                    'meter_no' => $payload['meter_no'],
                    'isValidated' =>  $payload['isValidated'] == 'true' ? true : false
                ];
    
                
            } else {
                $updateData = [
                    'firstname' => $payload['firstname'],
                    'lastname' => $payload['lastname'],
                    'middlename' => $payload['middlename'],
                    'address' => $payload['address'],
                    'contact_no' => $payload['contact_no'],
                    'email' => $payload['email'],
                ];

            }

            
            if(isset($payload['password'])) {
                $updateData['password'] = Hash::make($payload['password']);
            }

            User::where('id', $id)->update($updateData);

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Profile ' . ' updated.'
            ];

        } catch (\Exception $e) {
            
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => 'Error occured: ' . $e->getMessage()
            ];
        }

    }

}