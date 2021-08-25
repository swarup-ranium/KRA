<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk Register test.
     *
     * @return void
     */
    public function testRegister()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->type('#name', $user->name)
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->type('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertPathIs('/register');
        });
    }
    public function testAllFieldsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->press('REGISTER')
                    ->assertFocused('input[type=text]');
        });
    }

    public function testNameFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->type('#name', '')
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->type('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=text]');
        });
    }

    public function testEmailFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->type('#name', $user->name)
                    ->type('#email', '')
                    ->type('#password', $user->password)
                    ->type('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=email]');
        });
    }

    public function testPasswordFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->type('#name', $user->name)
                    ->type('#email', $user->email)
                    ->type('#password', '')
                    ->type('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=password]');
        });
    }

    public function testConfirmPasswordFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->type('#name', $user->name)
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->type('#password_confirmation', '')
                    ->press('REGISTER')
                    ->assertFocused('input[id=password_confirmation]');
        });
    }
}
