<?php

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a supplier with all fields', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $data = [
        'nama_supplier' => 'Supplier Test',
        'nama_perusahaan' => 'PT Test Indonesia',
        'no_telp' => '081234567890',
        'email' => 'supplier@test.com',
        'alamat' => 'Jl. Test No. 123',
        'kota' => 'Bandung',
        'kode_pos' => '40123',
        'saldo_hutang' => 1500000,
        'jatuh_tempo' => 14,
        'status' => 'aktif',
    ];

    $response = $this->actingAs($admin)
        ->post(route('suppliers.store'), $data);

    $response->assertRedirect(route('suppliers.index'));
    
    $this->assertDatabaseHas('suppliers', [
        'nama_supplier' => 'Supplier Test',
        'nama_perusahaan' => 'PT Test Indonesia',
        'no_telp' => '081234567890',
        'email' => 'supplier@test.com',
        'alamat' => 'Jl. Test No. 123',
        'kota' => 'Bandung',
        'kode_pos' => '40123',
        'saldo_hutang' => 1500000.00,
        'jatuh_tempo' => 14,
        'status' => 'aktif',
    ]);
});

test('admin can update a supplier with all fields', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $supplier = Supplier::create([
        'nama_supplier' => 'Supplier Lama',
        'saldo_hutang' => 500000,
        'jatuh_tempo' => 7,
        'status' => 'aktif',
    ]);

    $updatedData = [
        'nama_supplier' => 'Supplier Baru',
        'nama_perusahaan' => 'PT Baru Indonesia',
        'no_telp' => '08987654321',
        'email' => 'baru@test.com',
        'alamat' => 'Jl. Baru No. 456',
        'kota' => 'Jakarta',
        'kode_pos' => '10110',
        'saldo_hutang' => 2000000,
        'jatuh_tempo' => 30,
        'status' => 'nonaktif',
    ];

    $response = $this->actingAs($admin)
        ->put(route('suppliers.update', $supplier), $updatedData);

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'nama_supplier' => 'Supplier Baru',
        'nama_perusahaan' => 'PT Baru Indonesia',
        'no_telp' => '08987654321',
        'email' => 'baru@test.com',
        'alamat' => 'Jl. Baru No. 456',
        'kota' => 'Jakarta',
        'kode_pos' => '10110',
        'saldo_hutang' => 2000000.00,
        'jatuh_tempo' => 30,
        'status' => 'nonaktif',
    ]);
});

test('saldo_hutang and jatuh_tempo default to 0 if not provided or empty', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $data = [
        'nama_supplier' => 'Supplier Default',
        'status' => 'aktif',
    ];

    $response = $this->actingAs($admin)
        ->post(route('suppliers.store'), $data);

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'nama_supplier' => 'Supplier Default',
        'saldo_hutang' => 0.00,
        'jatuh_tempo' => 0,
    ]);
});
