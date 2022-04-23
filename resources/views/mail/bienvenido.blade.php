@component('mail::message')
# ¡Bienvenido(a) al sistema!
## 	Estimado(a) **{{$titular}}**:
Usuario: **{{$titular}}** para empezar a utilizar tu cuenta, solo tienes que confirmar tu dirección de correo electrónico y asignar una contraseña.

@component('mail::button', ['color' => 'red', 'url' => env('APP_URL').'/verify/'.$token])
Confirmar mi correo
@endcomponent
####Si no puedes ver el botón copia el siguiente link en tu navegador: {{env('APP_URL').'/verify/'.$token}}
@endcomponent