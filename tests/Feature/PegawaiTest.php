<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    private function pegawaiData(array $overrides = []): array
    {
        return array_merge([
            'nip' => '199001012020011001',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1990-01-01',
            'pendidikan_terakhir' => 'S1',
            'jabatan' => 'Staff IT',
            'alamat' => 'Jl. Merdeka No. 1',
        ], $overrides);
    }

    public function test_index_page_is_accessible(): void
    {
        $response = $this->actingAs($this->user)->get(route('pegawai.index'));
        $response->assertStatus(200);
    }

    public function test_create_page_is_accessible(): void
    {
        $response = $this->actingAs($this->user)->get(route('pegawai.create'));
        $response->assertStatus(200);
    }

    public function test_can_store_pegawai(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('pegawai.store'), $this->pegawaiData());

        $response->assertRedirect(route('pegawai.index'));
        $this->assertDatabaseHas('pegawais', ['nip' => '199001012020011001']);
        $this->assertDatabaseHas('audit_logs', ['action' => 'create', 'model_type' => 'Pegawai']);
    }

    public function test_cannot_store_pegawai_with_duplicate_nip(): void
    {
        Pegawai::create($this->pegawaiData());

        $response = $this->actingAs($this->user)
            ->post(route('pegawai.store'), $this->pegawaiData());

        $response->assertSessionHasErrors('nip');
    }

    public function test_validation_rejects_invalid_data(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('pegawai.store'), [
                'nip' => '',
                'nama' => '',
                'jenis_kelamin' => 'Invalid',
            ]);

        $response->assertSessionHasErrors(['nip', 'nama', 'jenis_kelamin']);
    }

    public function test_edit_page_is_accessible(): void
    {
        $pegawai = Pegawai::create($this->pegawaiData());

        $response = $this->actingAs($this->user)->get(route('pegawai.edit', $pegawai));
        $response->assertStatus(200);
    }

    public function test_can_update_pegawai(): void
    {
        $pegawai = Pegawai::create($this->pegawaiData());

        $response = $this->actingAs($this->user)
            ->put(route('pegawai.update', $pegawai), $this->pegawaiData(['nama' => 'Budi Updated']));

        $response->assertRedirect(route('pegawai.index'));
        $this->assertDatabaseHas('pegawais', ['nama' => 'Budi Updated']);
        $this->assertDatabaseHas('audit_logs', ['action' => 'update']);
    }

    public function test_can_delete_pegawai(): void
    {
        $pegawai = Pegawai::create($this->pegawaiData());

        $response = $this->actingAs($this->user)
            ->delete(route('pegawai.destroy', $pegawai));

        $response->assertRedirect(route('pegawai.index'));
        $this->assertDatabaseMissing('pegawais', ['id' => $pegawai->id]);
        $this->assertDatabaseHas('audit_logs', ['action' => 'delete']);
    }

    public function test_dashboard_is_accessible(): void
    {
        $response = $this->actingAs($this->user)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_export_downloads_csv(): void
    {
        Pegawai::create($this->pegawaiData());

        $response = $this->actingAs($this->user)->get(route('pegawai.export'));
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=utf-8');
    }

    public function test_search_filters_results(): void
    {
        Pegawai::create($this->pegawaiData(['nama' => 'Alpha']));
        Pegawai::create($this->pegawaiData(['nip' => '111', 'nama' => 'Beta']));

        $response = $this->actingAs($this->user)
            ->get(route('pegawai.index', ['search' => 'Alpha']));

        $response->assertStatus(200);
        $response->assertSee('Alpha');
        $response->assertDontSee('Beta');
    }

    public function test_guest_cannot_access_pegawai(): void
    {
        $response = $this->get(route('pegawai.index'));
        $response->assertRedirect(route('login'));
    }
}
