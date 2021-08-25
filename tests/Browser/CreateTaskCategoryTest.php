<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\TaskCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $taskCategry = TaskCategory::factory()->make();
        $this->browse(function (Browser $browser) use ($taskCategry) {
            $browser->loginAs($taskCategry->user_id)
                    ->visit('/taskCategory/create')
                    ->assertTitle('Laravel')
                    ->type('#categoryname', $taskCategry->name)
                    ->press('Add')
                    ->assertDontSee('The name field is required')
                    ->assertDontSee('Whoops! Something went wrong!')
                    ->assertPathIs('/taskCategory/create')
                    ->waitForText('Category added successfully')
                    ->assertSee('Category added successfully');
        });
    }

    public function testCheckAllFieldsEmpty()
    {
        $taskCategry = TaskCategory::factory()->make();
        $this->browse(function (Browser $browser) use ($taskCategry) {
            $browser->loginAs($taskCategry->user_id)
                    ->visit('/taskCategory/create')
                    ->assertTitle('Laravel')
                    ->press('Add')
                    ->waitForText('The name field is required')
                    ->assertSee('The name field is required');
        });
    }
}
