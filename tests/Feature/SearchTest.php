<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_search_items_case_insensitively()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create(['status' => 'approved']);

        // Create items with mixed case names
        Item::factory()->create([
            'name' => 'LAPTOP ASUS',
            'description' => 'Gaming laptop',
            'location' => 'Office A',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
        ]);

        Item::factory()->create([
            'name' => 'Mouse Logitech',
            'description' => 'Wireless mouse',
            'location' => 'Office B',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
        ]);

        // Test case insensitive search for name
        $response = $this->actingAs($admin)->get(route('admin.items.index', ['search' => 'laptop']));
        $response->assertStatus(200);
        $response->assertSee('LAPTOP ASUS');

        $response = $this->actingAs($admin)->get(route('admin.items.index', ['search' => 'LAPTOP']));
        $response->assertStatus(200);
        $response->assertSee('LAPTOP ASUS');

        // Test case insensitive search for description
        $response = $this->actingAs($admin)->get(route('admin.items.index', ['search' => 'gaming']));
        $response->assertStatus(200);
        $response->assertSee('LAPTOP ASUS');

        $response = $this->actingAs($admin)->get(route('admin.items.index', ['search' => 'GAMING']));
        $response->assertStatus(200);
        $response->assertSee('LAPTOP ASUS');

        // Test case insensitive search for location
        $response = $this->actingAs($admin)->get(route('admin.items.index', ['search' => 'office']));
        $response->assertStatus(200);
        $response->assertSee('LAPTOP ASUS');
        $response->assertSee('Mouse Logitech');
    }

    /** @test */
    public function admin_can_search_categories_case_insensitively()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create categories with mixed case names
        Category::factory()->create([
            'name' => 'Electronics',
            'description' => 'Electronic devices',
        ]);

        Category::factory()->create([
            'name' => 'Furniture',
            'description' => 'Office furniture',
        ]);

        // Test case insensitive search for name
        $response = $this->actingAs($admin)->get(route('admin.categories.index', ['search' => 'electronics']));
        $response->assertStatus(200);
        $response->assertSee('Electronics');

        $response = $this->actingAs($admin)->get(route('admin.categories.index', ['search' => 'ELECTRONICS']));
        $response->assertStatus(200);
        $response->assertSee('Electronics');

        // Test case insensitive search for description
        $response = $this->actingAs($admin)->get(route('admin.categories.index', ['search' => 'devices']));
        $response->assertStatus(200);
        $response->assertSee('Electronics');
    }

    /** @test */
    public function admin_can_search_suppliers_case_insensitively()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create suppliers with mixed case names
        Supplier::factory()->create([
            'name' => 'PT ABC Supplier',
            'contact_email' => 'contact@abc.com',
            'status' => 'approved',
        ]);

        Supplier::factory()->create([
            'name' => 'XYZ Corporation',
            'contact_email' => 'info@xyz.com',
            'status' => 'approved',
        ]);

        // Test case insensitive search for name
        $response = $this->actingAs($admin)->get(route('admin.suppliers.index', ['search' => 'abc']));
        $response->assertStatus(200);
        $response->assertSee('PT ABC Supplier');

        $response = $this->actingAs($admin)->get(route('admin.suppliers.index', ['search' => 'ABC']));
        $response->assertStatus(200);
        $response->assertSee('PT ABC Supplier');

        // Test case insensitive search for email
        $response = $this->actingAs($admin)->get(route('admin.suppliers.index', ['search' => 'contact@abc.com']));
        $response->assertStatus(200);
        $response->assertSee('PT ABC Supplier');
    }

    /** @test */
    public function guest_can_search_items_case_insensitively()
    {
        $guest = User::factory()->create(['role' => 'guest']);
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create(['status' => 'approved']);

        // Create items with mixed case names
        Item::factory()->create([
            'name' => 'Printer HP',
            'description' => 'Color printer',
            'location' => 'Storage Room',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
        ]);

        // Test case insensitive search
        $response = $this->actingAs($guest)->get(route('guest.items.index', ['search' => 'printer']));
        $response->assertStatus(200);
        $response->assertSee('Printer HP');

        $response = $this->actingAs($guest)->get(route('guest.items.index', ['search' => 'PRINTER']));
        $response->assertStatus(200);
        $response->assertSee('Printer HP');
    }
}
