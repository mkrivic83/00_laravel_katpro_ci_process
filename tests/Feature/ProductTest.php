<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'isAdmin' => true,
            'datum_rod' => '1980-01-01',
            'placa'=>3000,
        ]);
    }

    private function user(): User
    {
        return User::factory()->create([
            'isAdmin'=>false,
            'datum_rod' => '1990-10-01',
            'placa'=>1500
        ]);
    }

    private function category(): Category
    {
        return Category::create([
            'naziv'=>'Laptopi',
            'opis'=>'Prijenosna računala'
        ]);
    }

    private function product(): Product
    {
        $category = $this->category();
        return Product::create([
            'category_id'=>$category->id,
            'naziv'=>'Lenovo ThinkPad',
            'opis'=>'Poslovni laptop',
            'cijena'=>799.99,
            'kolicina'=>10,
            'izvor'=>'custom',
        ]);
    }

    public function test_admin_moze_vidjeti_listu_proizvoda(): void
    {
        $admin=$this->admin();
        $this->product();

        $response = $this->actingAs($admin)
                         ->get(route('products.index'));
        
        $response->assertStatus(200);
        $response->assertSee('Lenovo ThinkPad');

        $this->assertDatabaseHas('products',[
            'naziv'=>'Lenovo ThinkPad',
        ]);
    }

    //da obican korisnik moze vidjeti listu proizvoda
    public function test_obican_korisnik_moze_vidjeti_listu_proizvoda(): void
    {
        $user=$this->user();
        $this->product();

        $response = $this->actingAs($user)
                         ->get(route('products.index'));
        
        $response->assertStatus(200);
        $response->assertSee('Lenovo ThinkPad');

    }

    public function test_admin_moze_vidjeti_formu_novi_proizvod(): void
    {
        $admin = $this->admin();
        $this->category();
        
        $response = $this->actingAs($admin)->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Novi proizvod');
    }

    //obican korisnk ne moze vidjeit formu za novi proizvod
     public function test_obican_korisnik_ne_moze_vidjeti_formu_novi_proizvod(): void
    {
        $user = $this->user();
        $this->category();
        
        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(403);
    }

    //napraviti test da admin može dodati novi proizvod
    //redirekcija
    //provjera u bazi
    //provjera success poruke
    public function test_admin_moze_dodati_novi_proizvod(): void
    {
        $admin = $this->admin();
        $category = $this->category();

        $response = $this->actingAs($admin)
            ->post(route('products.store'),[
                'category_id'=>$category->id,
                'naziv'=>'Lenovo ThinkPad',
                'opis'=>'Poslovni laptop',
                'cijena'=>799.99,
                'kolicina'=>10,
                'izvor'=>'custom',
            ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products',[
            'naziv'=>'Lenovo ThinkPad',
            'izvor'=>'custom',
            'cijena'=>799.99
        ]);

        $response->assertSessionHas(
            'success',
            'Proizvod je uspješno dodan'
        );
    }

    public function test_admin_moze_obrisati_proizvod(): void
    {
        $admin=$this->admin();
        $product = $this->product();

        $response = $this->actingAs($admin)->delete(route('products.destroy',$product));
        $response->assertRedirect(route('products.index'));

        $response->assertSessionHas(
            'success',
            'Proizvod je uspješno izbrisan'
        );

        $this->assertDatabaseMissing('products',[
            'id'=>$product->id,
        ]);

    }

    public function test_detalji_proizvoda_prikazuju_kategoriju(): void
    {
        $user=$this->user();
        $product = $this->product();

        $response = $this->actingAs($user)->get(route('products.show',$product));

        $response->assertStatus(200);
        $response->assertSee('Laptopi');
        $response->assertSee('Lenovo ThinkPad');
    }

    //test search proizvoda po nazivu radi
    //napraviti test za validaciju kolicine i cijene da moraju biti unesene

    
}
