<?php

namespace Tests\Unit\Policies;

use App\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class ProveedorPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_proveedor()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Proveedor));
    }

    /** @test */
    public function user_can_view_proveedor()
    {
        $user = $this->createUser();
        $proveedor = factory(Proveedor::class)->create();
        $this->assertTrue($user->can('view', $proveedor));
    }

    /** @test */
    public function user_can_update_proveedor()
    {
        $user = $this->createUser();
        $proveedor = factory(Proveedor::class)->create();
        $this->assertTrue($user->can('update', $proveedor));
    }

    /** @test */
    public function user_can_delete_proveedor()
    {
        $user = $this->createUser();
        $proveedor = factory(Proveedor::class)->create();
        $this->assertTrue($user->can('delete', $proveedor));
    }
}
