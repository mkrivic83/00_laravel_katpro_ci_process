<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

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

    public function test_admin_moze_vidjeti_listu_kategorija(): void
    {
        /*
         * ARRANGE
         */
        $admin = $this->admin();
        Category::create([
            'naziv'=>'Mobiteli',
            'opis'=>'Pametni telefoni',
        ]);

        /*
         * ACT
         */

        $response = $this->actingAs($admin)
        ->get(route('categories.index'));
        /*
         * ASSERT
         */
        $response->assertStatus(200);
        $response->assertSee('Mobiteli');
    }

    public function test_obicni_korisnik_moze_vidjeti_listu_kategorija(): void
    {
        $user = $this->user();
        Category::create([
            'naziv'=>'Laptopi',
            'opis'=>'Prijenosna računala',
        ]);

        $response = $this->actingAs($user)->get(route('categories.index'));
        $response->assertStatus(200);
        $response->assertSee('Laptopi');
    }

    public function test_admin_moze_dodati_kategoriju(): void
    {
        $admin = $this->admin();
        $response = $this->actingAs($admin)
            ->post(route('categories.store'),[
                'naziv'=>'Monitori',
                'opis' => 'Računalni monitori',
            ]);
        
        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories',[
            'naziv'=>'Monitori',
        ]);
    }

    public function test_admin_moze_azurirati_kategoriju(): void
    {
        $admin = $this->admin();
        $category = Category::create([
            'naziv'=>'Stari naziv',
            'opis'=>'Opis'
        ]);

        $response = $this->actingAs($admin)
            ->put(route('categories.update',$category),[
                'naziv' => 'Novi naziv',
                'opis'=>'Novi opis',
            ]);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories',[
            'naziv'=>'Novi naziv',
        ]);

    }

    public function test_obican_korisnik_ne_moze_dodati_kategoriju(): void
    {
        $user = $this->user();
        $response = $this->actingAs($user)
            ->post(route('categories.store'),[
                'naziv'=>'Zabranjena kategorija',
                'opis'=>'Neki opis'
            ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('categories',[
            'naziv'=>'Zabranjena kategorija',
        ]);
    }

    public function test_admin_moze_obrisati_kategoriju(): void
    {
        //Arrange (priprema podataka)
        $admin=$this->admin();
        $category = Category::create([
            'naziv'=>'Mobiteli',
            'opis'=>'Opis'
        ]);

        //Act - izvršavanje akcije
        $response = $this->actingAs($admin)
            ->delete(route('categories.destroy',$category));

        //Assert - provjera rezultata
        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseMissing('categories',[
            'id'=>$category->id,
        ]);
    }

    //napraviti test koji provjerava da običan korisnik ne može obrisati kategoriju
        public function test_obican_korisnik_nemoze_obrisati_kategoriju(): void
        {
            //Arrange (priprema podataka)
            $user=$this->user();
            $category = Category::create([
                'naziv'=>'Mobiteli',
                'opis'=>'Opis'
            ]);

            //Act - izvršavanje akcije
            $response = $this->actingAs($user)
                ->delete(route('categories.destroy',$category));

            //Assert - provjera rezultata
            $response->assertForbidden();

            $this->assertDatabaseHas('categories',[
                'id'=>$category->id,
            ]);
        }

        public function test_validacija_ne_dozvoljava_prazan_naziv_kategorije(): void
        {
            //Arrange
            $admin = $this->admin();

            //Act
            $response = $this
                ->from(route('categories.create'))
                ->actingAs($admin)
                ->post(route('categories.store'),[
                    'naziv'=>'',
                    'opis' => 'Opis nove kategorije',
                ]);

            //Assert
            $response->assertRedirect(route('categories.create'));
            $response->assertSessionHasErrors([
                'naziv'
            ]);

            $this->assertDatabaseMissing('categories',[
                'opis'=>'Opis nove kategorije',
            ]);
        }

        public function test_validacija_minimalne_duljine_naziva(): void
        {
            //Arrange
            $admin = $this->admin();

            //Act
            $response = $this
                ->from(route('categories.create'))
                ->actingAs($admin)
                ->post(route('categories.store'),[
                    'naziv'=>'TV',
                    'opis'=>'Opis kategorije',
                ]);

            //Assert
            $response->assertRedirect(route('categories.create'));

            $response->assertSessionHasErrors([
                'naziv',
            ]);

            $this->assertDatabaseMissing('categories',[
                'naziv'=>'TV'
            ]);
        }

        #TEST KOJI ĆE NAMJERNO PUKNUTI
        // public function test_validacija_opis_je_obavezan(): void
        // {
        //     $admin = $this->admin();

        //     $response = $this
        //         ->from(route('categories.create'))
        //         ->actingAs($admin)
        //         ->post(route('categories.store'),[
        //             'naziv'=>'Laptopi',
        //             'opis'=>'',
        //         ]);

        //     $response->assertRedirect(route('categories.create'));

        //     $response->assertSessionHasErrors(['opis']);

        //     $this->assertDatabaseMissing('categories',[
        //         'naziv'=>'Laptopi',
        //     ]);
        // }

        public function test_validacija_opis_nije_obavezan(): void
        {
            $admin = $this->admin();

            $response = $this
                ->actingAs($admin)
                ->post(route('categories.store'),[
                    'naziv'=>'Laptopi',
                    'opis'=>'',
                ]);

            $response->assertRedirect(route('categories.index'));

            $this->assertDatabaseHas('categories',[
                'naziv'=>'Laptopi',
            ]);

            $response->assertSessionDoesntHaveErrors();
        }

        public function test_poruka_uspjesnosti_kreiranja_kategorije(): void
        {
            $admin = $this->admin();

            $response = $this
                ->actingAs($admin)
                ->post(route('categories.store'),[
                    'naziv'=>'Mobiteli',
                    'opis'=>'Pametni telefoni'
                ]);

            $response->assertRedirect(route('categories.index'));

            $response->assertSessionHas('success','Kategorija "Mobiteli" uspješno kreirana');
        }
}
