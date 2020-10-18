<?php

namespace Tests\Feature;

use App\User;
use App\Loan;
use App\Payment;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Session;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->setupPermissions();

        $this->customer = factory(User::class)->create();
        $this->customer->assignRole('customer');

        $this->admin = factory(User::class)->create();
        $this->admin->assignRole('admin');

    }

    protected function setupPermissions()
    {
        app()['cache']->forget('spatie.permission.cache');

        Permission::findOrCreate('manage dashboard');
        Permission::findOrCreate('manage admins');
        Permission::findOrCreate('manage customers');
        Permission::findOrCreate('manage loans');
        Permission::findOrCreate('manage profile');
        Permission::findOrCreate('manage options');
        Permission::findOrCreate('manage payments');

        $customer = Role::findOrCreate('customer');
        $customer->givePermissionTo(['manage dashboard', 'manage loans', 'manage profile', 'manage payments']);

        $admin = Role::findOrCreate('admin');
        $admin->givePermissionTo(['manage dashboard', 'manage admins', 'manage customers', 'manage loans', 'manage profile', 'manage options', 'manage payments']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();

    }

    /** @test */
    public function admin_or_customer_can_view_login_page()
    {
        $this->get('/login')->assertStatus(200)->assertViewIs('site.auth.login');
    }

    /** @test */
    public function logged_in_admin_when_visits_log_in_page_redirected_to_admin_dashboard_page()
    {
        $admin = $this->admin;
        $this->actingAs($admin)->get('/login')->assertRedirect('/admin/dashboard');
    }

    /** @test */
    public function logged_in_customer_when_visits_log_in_page_redirected_to_customer_dashboard_page()
    {
        $customer = $this->customer;
        $this->actingAs($customer)->get('/login')->assertRedirect('/customer/dashboard');
    }

    /** @test */
    public function unaunthenticated_user_when_visits_customer_dashboard_page_redirected_to_login_page()
    {
        $this->get('/customer/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function unaunthenticated_user_when_visits_admin_dashboard_page_redirected_to_login_page()
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_admin_can_view_loan_index_page()
    {
        $admin = $this->admin;
        $this->actingAs($admin)->get('/admin/loans')->assertStatus(200)->assertViewIs('admin.loan.index');
    }

    /** @test */
    public function logged_in_customer_customer_can_view_loan_index_page()
    {
        $customer = $this->customer;
        $this->actingAs($customer)->get('/customer/loans')->assertStatus(200)->assertViewIs('admin.loan.index');
    }

    /** @test */
    public function unauthenticated_user_when_access_loan_apply_url_redirect_to_login()
    {
        $this->get('customer/loan/apply')->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_customer_when_applies_for_loan_without_values()
    {
        Session::start();
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => NULL,
             'user_id' => $customer->id,
             'term' => NULL,
             'amount' => NULL,
             'outstanding_amount' => NULL,
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );
        $this->assertEquals(0, Loan::count()); // No records inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_when_applies_for_loan_without_only_term_value()
    {
        Session::start();
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => NULL,
             'amount' => '20000',
             'outstanding_amount' => '20000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );
        $this->assertEquals(0, Loan::count()); // No records inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_when_applies_for_loan_without_only_amount_value()
    {
        Session::start();
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => NULL,
             'outstanding_amount' => NULL,
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );
        $this->assertEquals(0, Loan::count()); // No records inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_can_apply_for_loan_with_correct_values()
    {
        Session::start();
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '20000',
             'outstanding_amount' => '20000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );
        $this->assertEquals(1, Loan::count()); // 1 record inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_paying_weekly_repayment_without_values()
    {
        Session::start();
        $customer = $this->customer;
        $encryptId = Crypt::encrypt(2);

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 2,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '20000',
             'outstanding_amount' => '20000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $this->actingAs($customer)->post('customer/loan/'.$encryptId.'/update-payment',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => 2,
             'amount' => NULL,
             'date' => new DateTime,
             'week' => 1
            ]
        );
        $this->assertEquals(0, Payment::count()); // No records inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_paying_weekly_repayment_with_correct_values()
    {
        Session::start();
        $customer = $this->customer;
        $encryptId = Crypt::encrypt(3);

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 3,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '20000',
             'outstanding_amount' => '20000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $this->actingAs($customer)->post('customer/loan/'.$encryptId.'/update-payment',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => 3,
             'amount' => '2500',
             'date' => new DateTime,
             'week' => 1
            ]
        );
        $this->assertEquals(1, Payment::count()); // 1 record inserted in to DB.
    }

    /** @test */
    public function logged_in_customer_checking_payment_history()
    {
        Session::start();
        $customer = $this->customer;
        $encryptId = Crypt::encrypt(4);

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 4,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 1,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $this->actingAs($customer)->post('customer/loan/'.$encryptId.'/update-payment',
            ['_token' => csrf_token(),
             'id' => 2,
             'loan_id' => 4,
             'amount' => '2500',
             'date' => new DateTime,
             'week' => 1
            ]
        );

        $this->actingAs(User::find($customer->id))->get('customer/loan/'.$encryptId.'/view')
        ->assertViewIs('admin.loan.view')
        ->assertSee('View loan ID: #100000');
    }

    /** @test */
    public function logged_in_admin_approving_loan()
    {
        Session::start();
        $encryptId = Crypt::encrypt(5);
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 5,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $admin = $this->admin;

        $this->actingAs($admin)->get('admin/loan/'.$encryptId.'/update-status-approve/update');

        $this->assertDatabaseHas('loans',
            ['id' => 5,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 3,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 1, // Status updated to 1 (Approved).
            ]
        );
    }

    /** @test */
    public function logged_in_admin_rejecting_loan()
    {
        Session::start();
        $encryptId = Crypt::encrypt(6);
        $customer = $this->customer;

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 6,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 1,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 0,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $admin = $this->admin;

        $this->actingAs($admin)->get('admin/loan/'.$encryptId.'/update-status-reject/update')->assertStatus(302);

        $this->assertDatabaseHas('loans',
            ['id' => 6,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 1,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 2, // Status updated to 2 (Rejected).
            ]
        );
    }

    /** @test */
    public function logged_in_admin_checking_payment_history()
    {
        Session::start();
        $customer = $this->customer;
        $encryptId = Crypt::encrypt(7);

        $this->actingAs($customer)->post('customer/loan/apply',
            ['_token' => csrf_token(),
             'id' => 7,
             'loan_id' => '100000',
             'user_id' => $customer->id,
             'term' => 1,
             'amount' => '10000',
             'outstanding_amount' => '10000',
             'status' => 1,
             'created_at' => new DateTime,
             'updated_at' => new DateTime
            ]
        );

        $this->actingAs($customer)->post('customer/loan/'.$encryptId.'/update-payment',
            ['_token' => csrf_token(),
             'id' => 1,
             'loan_id' => 7,
             'amount' => '2500',
             'date' => new DateTime,
             'week' => 1
            ]
        );

        $admin = $this->admin;

        $this->actingAs($admin)->get('admin/loan/'.$encryptId.'/view')

        ->assertViewIs('admin.loan.view')
        ->assertSee('View loan ID: #100000');
    }
}
