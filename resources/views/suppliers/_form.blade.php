<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    <!-- ===================== -->
    <!-- DATA SUPPLIER -->
    <!-- ===================== -->
    <div class="md:col-span-2 font-bold text-slate-700">Data Supplier</div>

    <!-- Nama Supplier -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Nama Supplier
        </label>
        <input type="text" name="nama_supplier"
            value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}"
            class="input"
            placeholder="Contoh: UD Sumber Makmur">
    </div>

    <!-- Nama Perusahaan -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Nama Perusahaan
        </label>
        <input type="text" name="nama_perusahaan"
            value="{{ old('nama_perusahaan', $supplier->nama_perusahaan ?? '') }}"
            class="input"
            placeholder="Contoh: Distributor Sembako">
    </div>

    <!-- No HP -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Nomor HP
        </label>
        <input type="text" name="no_telp"
            value="{{ old('no_telp', $supplier->no_telp ?? '') }}"
            class="input"
            placeholder="Contoh: 08123456789">
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Email
        </label>
        <input type="email" name="email"
            value="{{ old('email', $supplier->email ?? '') }}"
            class="input"
            placeholder="Contoh: supplier@email.com">
    </div>

    <!-- Alamat -->
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Alamat Lengkap
        </label>
        <textarea name="alamat"
            class="input"
            placeholder="Masukkan alamat lengkap supplier">{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
    </div>

    <!-- Kota -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Kota
        </label>
        <input type="text" name="kota"
            value="{{ old('kota', $supplier->kota ?? '') }}"
            class="input"
            placeholder="Contoh: Subang">
    </div>

    <!-- Kode Pos -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Kode Pos
        </label>
        <input type="text" name="kode_pos"
            value="{{ old('kode_pos', $supplier->kode_pos ?? '') }}"
            class="input"
            placeholder="Contoh: 41211">
    </div>

    <!-- ===================== -->
    <!-- DATA KEUANGAN -->
    <!-- ===================== -->
    <div class="md:col-span-2 font-bold text-slate-700 mt-4">Data Keuangan</div>

    <!-- Saldo Hutang -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Saldo Hutang
        </label>
        <input type="number" name="saldo_hutang"
    value="{{ old('saldo_hutang', $supplier->saldo_hutang ?? 0) }}"
    class="input"
    placeholder="Contoh: 1000000">
    </div>

    <!-- Jatuh Tempo -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Jatuh Tempo (Hari)
        </label>
        <input type="number" name="jatuh_tempo"
            value="{{ old('jatuh_tempo', $supplier->jatuh_tempo ?? 0) }}"
            class="input"
            placeholder="Contoh: 7 hari">
    </div>

    <!-- ===================== -->
    <!-- STATUS -->
    <!-- ===================== -->
    <div class="md:col-span-2 mt-4">
        <label class="block text-sm font-semibold text-slate-600 mb-1">
            Status Supplier
        </label>
        <select name="status" class="input">
            <option value="aktif" {{ (old('status', $supplier->status ?? '') == 'aktif') ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="nonaktif" {{ (old('status', $supplier->status ?? '') == 'nonaktif') ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>
    </div>

</div>