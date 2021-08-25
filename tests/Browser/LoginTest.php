<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk login test.
     *
     * @return void
     */
    public function testCheckEmailFieldEmpty()
    {
        $user = User::factory()->make(['password' => bcrypt('12345678')]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('#email', '')
                    ->type('#password', 12345678)
                    ->press('LOG IN')
                    ->assertFocused('input[type=email]');
        });
    }

    public function testCheckPasswordFieldEmpty()
    {
        $user = User::factory()->make(['password' => bcrypt('12345678')]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('#email', $user->email)
                    ->type('#password', '')
                    ->press('LOG IN')
                    ->assertFocused('input[type=password]');
        });
    }
    public function testInvalidLogin()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('#email', $user->email)
                    ->type('#password', $user->password)
                    ->press('LOG IN')
                    ->waitForText('Whoops! Something went wrong')
                    ->assertSee('Whoops! Something went wrong')
                    ->assertSee('These credentials do not match our records');
        });
    }
    public function testLogin()
    {
        $user = User::factory()->create(['password' => bcrypt('12345678')]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('#email', $user->email)
                    ->type('#password', 12345678)
                    ->press('LOG IN')
                    ->assertDontSee('These credentials do not match our records')
                    ->assertDontSee('Whoops! Something went wrong')
                    ->assertPathIs('/login');
        });
    }
}
