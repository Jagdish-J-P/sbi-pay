<?php

namespace JagdishJP\SBIPay\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JagdishJP\SBIPay\Messages\PaymentRequest as PaymentRequestMessage;

class PaymentRequest extends FormRequest
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
        return [];
    }

    /**
     * Presist the data to the users table.
     */
    public function handle()
    {
        return (new PaymentRequestMessage())->handle($this->all());
    }
}
