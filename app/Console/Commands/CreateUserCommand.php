<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userData['name'] = $this->ask('What is the user name');
        $userData['email'] = $this->ask('What is the user email');
        $userData['password'] = $this->secret('What is the user password');

        $roleName = $this->choice('What is the user\'s role', ['admin', 'editor'], 1);
        $role = Role::where('name', $roleName)->first();
        if (! $role) {
            $this->error('Role does not exists');

            return -1;
        }

        // Validation
        $validator = Validator::make($userData, [
            'name' => ['string', 'required', 'min:3', 'max:30'],
            'email' => ['string', 'email', 'required'],
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return -1;
        }

        DB::transaction(function () use ($userData, $role) {
            $userData['password'] = bcrypt($userData['password']);
            $user = User::create($userData);
            $user->roles()->attach($role->id);
        });

        $this->info('User Created Successfully.');

        return 0;
    }
}
