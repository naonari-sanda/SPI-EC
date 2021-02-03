<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Acount extends Model
{
    protected $guarded = [
        'id'
    ];

    public function getAdress($id)
    {
        $adress = $this->where('user_id', $id)->first();

        return $adress;
    }

    public function getHistory($id)
    {
        $lists = $this->find($id);

        return $lists;
    }

    public function createAdress($data)
    {
        $user_id = Auth::id();

        $adress = $this->create([
            'user_id' => $user_id,
            'zipcode' => $data['zipcode'],
            'prefecture' => $data['prefecture'],
            'adress' => $data['adress']
        ]);

        if ($adress->wasRecentlyCreated) {
            $message = 'お届け先を登録しました';
        } else {
            $message = 'お届け先の登録に失敗しました';
        }

        return $message;
    }

    public function updateAdress($data)
    {
        $user_id = Auth::id();
        $change = $this->where('user_id', $user_id)->update($data);

        if ($change > 0) {
            $message = 'お届け先を変更しました';
        } else {
            $message = 'お届け先の登録に失敗しました';
        }

        return $message;
    }
}
