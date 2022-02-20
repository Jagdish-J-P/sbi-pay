<?php

namespace JagdishJP\SBIPay\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JagdishJP\SBIPay\Messages\PaymentConfirmationMessage;

class PaymentConfirmationRequest extends FormRequest
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
        return (new PaymentConfirmationMessage())->handle($this->all());
    }
}
