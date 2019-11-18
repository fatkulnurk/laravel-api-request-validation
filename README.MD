
# LARAVEL API REQUEST VALIDATION
kegunaanya untuk memberikan hasil return berupa json, untuk field apa aja yang menyebabkan error saat request, beserta message error dan old value.
## Latar Belakang
Jadi begini, awalnya akutuh bingung mau buat validation request buat api, usut punya usut ternyata aku nemu artikel dari
cwhite.me, isinya dia bikin class untuk abstraction form request bawaan laravel. Yaudah dari situ aku jadiin package aja, biar kalau dipakai tinggal install doang.


## Cara Penggunaan
- Install package menggunakan composer `composer require fatkulnurk/laravel-api-request-validation`.
- lalu jalankan `composer dump-autoload` (enggak juga tidak apa apa).
- pada request yang anda buat (defaultnya di folder app/http/request) ganti extendsnya dari FormRequest menjadi FormRequestApi dari yang awalnya

```

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
            'remember_me' => 'nullable|boolean'
        ];
    }
}
```
Menjadi seperti ini
```
<?php

namespace App\Http\Requests;

use Fatkulnurk\LaravelApiRequestValidation\FormRequestApi;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequestApi
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
            'remember_me' => 'nullable|boolean'
        ];
    }
}

```
