<?php

namespace Tests\Unit\Models;

use App\User;
use App\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class ProveedorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_proveedor_has_name_link_attribute()
    {
        $proveedor = factory(Proveedor::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $proveedor->name, 'type' => __('proveedor.proveedor'),
        ]);
        $link = '<a href="'.route('proveedors.show', $proveedor).'"';
        $link .= ' title="'.$title.'">';
        $link .= $proveedor->name;
        $link .= '</a>';

        $this->assertEquals($link, $proveedor->name_link);
    }

    /** @test */
    public function a_proveedor_has_belongs_to_creator_relation()
    {
        $proveedor = factory(Proveedor::class)->make();

        $this->assertInstanceOf(User::class, $proveedor->creator);
        $this->assertEquals($proveedor->creator_id, $proveedor->creator->id);
    }
}
