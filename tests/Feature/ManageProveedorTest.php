<?php

namespace Tests\Feature;

use App\Proveedor;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProveedorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_proveedor_list_in_proveedor_index_page()
    {
        $proveedor = factory(Proveedor::class)->create();

        $this->loginAsUser();
        $this->visitRoute('proveedors.index');
        $this->see($proveedor->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Proveedor 1 name',
            'description' => 'Proveedor 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_proveedor()
    {
        $this->loginAsUser();
        $this->visitRoute('proveedors.index');

        $this->click(__('proveedor.create'));
        $this->seeRouteIs('proveedors.create');

        $this->submitForm(__('proveedor.create'), $this->getCreateFields());

        $this->seeRouteIs('proveedors.show', Proveedor::first());

        $this->seeInDatabase('proveedors', $this->getCreateFields());
    }

    /** @test */
    public function validate_proveedor_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('proveedors.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_proveedor_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('proveedors.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_proveedor_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('proveedors.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Proveedor 1 name',
            'description' => 'Proveedor 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_proveedor()
    {
        $this->loginAsUser();
        $proveedor = factory(Proveedor::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('proveedors.show', $proveedor);
        $this->click('edit-proveedor-'.$proveedor->id);
        $this->seeRouteIs('proveedors.edit', $proveedor);

        $this->submitForm(__('proveedor.update'), $this->getEditFields());

        $this->seeRouteIs('proveedors.show', $proveedor);

        $this->seeInDatabase('proveedors', $this->getEditFields([
            'id' => $proveedor->id,
        ]));
    }

    /** @test */
    public function validate_proveedor_name_update_is_required()
    {
        $this->loginAsUser();
        $proveedor = factory(Proveedor::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('proveedors.update', $proveedor), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_proveedor_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $proveedor = factory(Proveedor::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('proveedors.update', $proveedor), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_proveedor_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $proveedor = factory(Proveedor::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('proveedors.update', $proveedor), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_proveedor()
    {
        $this->loginAsUser();
        $proveedor = factory(Proveedor::class)->create();
        factory(Proveedor::class)->create();

        $this->visitRoute('proveedors.edit', $proveedor);
        $this->click('del-proveedor-'.$proveedor->id);
        $this->seeRouteIs('proveedors.edit', [$proveedor, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('proveedors', [
            'id' => $proveedor->id,
        ]);
    }
}
