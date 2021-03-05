<?php

namespace App\Http\Requests\Order;

use App\DataTransferObjects\CreateOrderData;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping_id' => 'required | integer | exists:App\Models\Shipping,id',
            'product_id' => 'required | integer | exists:App\Models\Product,id',
            'client_name' => 'required | string',
            'client_address' => 'required | string',
        ];
    }

    public function data(): CreateOrderData
    {
        return CreateOrderData::fromRequest($this);
    }
}
