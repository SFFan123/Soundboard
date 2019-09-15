<?php

namespace Soundboard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Soundboard\Role;
use Soundboard\User;

class makeAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:AdminAccount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an Admin account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = trim($this->ask("The e-mail for the account?"));
        $username = trim($this->ask("The Name for the account?"));
        $pass = Str::random(9);
        if($username == ""){
            $this->error("invalid user name");
            return false;
        }
        if($email == ""){
            $this->error("invalid user name");
            return false;
        }

        $user = new User();
        $user->name = $username;
        $user->password = Hash::make($pass);
        $user->email = $email;
        $user->save();

        $user->roles()->attach(Role::find(1));


        $this->info("The account " . $username . " with the email " . $email . " has been created and given the password: " . $pass);

        return true;

    }
}
