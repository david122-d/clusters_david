<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        //Se agregaron nuevos campos a la funcion de validar los valores al momento de crear el usuario,
        //Recibe los valores que ingreso el usuario y verifica si cumplen con los requisitos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],//Se valida la insercion de el apillido que puede ser nulo debe ser un string y tener un hancho maximo de 255 caracteres
            'turn' => ['nullable', 'in:morning,evening,night'],//Se valida la incercion de el turno que puede ser nulo y solo puede tener los valores morning,evening,night
            'action' => ['nullable', 'in:rest,patrolling,in stand,out of service'], //Se valida la incercion de la accion que puede ser nulo y solo puede tener los valores rest,patrolling,in stand,out of service
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'cluster_id' => ['required', 'exists:clusters,id'], //La llave foranea cluster id no puede ser nula y debe existir en la tabla clusters en la columna id
            'stand_id' => ['nullable', 'exists:stands,id'],//La llave foranea stand_id puede ser nula y debe de existir en la tabla stands en la columna id
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'last_name' => $input['last_name'],
                'turn' => $input['turn'],
                'action' => $input['action'],
                'email' => $input['email'],
                'cluster_id' => $input['cluster_id'],
                'stand_id' => $input['stand_id'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'turn' => $input['turn'],
            'action' => $input['action'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'cluster_id' => $input['cluster_id'],
            'stand_id' => $input['stand_id'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
