<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    <!-- ===================== -->
    <!-- DATA SUPPLIER -->
    <!-- ===================== -->
    <div class="md:col-span-2 font-bold text-slate-700 dark:text-slate-300">Data Supplier</div>

    <!-- Nama Supplier -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Nama Supplier
        </label>
        <input type="text" name="nama_supplier"
            value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: UD Sumber Makmur">
    </div>

    <!-- Nama Perusahaan -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Nama Perusahaan
        </label>
        <input type="text" name="nama_perusahaan"
            value="{{ old('nama_perusahaan', $supplier->nama_perusahaan ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: Distributor Sembako">
    </div>

    <!-- No HP -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Nomor HP
        </label>
        <input type="text" name="no_telp"
            value="{{ old('no_telp', $supplier->no_telp ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: 08123456789">
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Email
        </label>
        <input type="email" name="email"
            value="{{ old('email', $supplier->email ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: supplier@email.com">
    </div>

    <!-- Alamat -->
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Alamat Lengkap
        </label>
        <textarea name="alamat"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium min-h-[100px]"
            placeholder="Masukkan alamat lengkap supplier">{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
    </div>

    <!-- Kota -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Kota
        </label>
        <input type="text" name="kota"
            value="{{ old('kota', $supplier->kota ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: Subang">
    </div>

    <!-- Kode Pos -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Kode Pos
        </label>
        <input type="text" name="kode_pos"
            value="{{ old('kode_pos', $supplier->kode_pos ?? '') }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: 41211">
    </div>

    <!-- ===================== -->
    <!-- DATA KEUANGAN -->
    <!-- ===================== -->
    <div class="md:col-span-2 font-bold text-slate-700 dark:text-slate-300 mt-4">Data Keuangan</div>

    <!-- Saldo Hutang -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Saldo Hutang
        </label>
        <input type="number" name="saldo_hutang"
    value="{{ old('saldo_hutang', $supplier->saldo_hutang ?? 0) }}"
    class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
    placeholder="Contoh: 1000000">
    </div>

    <!-- Jatuh Tempo -->
    <div>
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Jatuh Tempo (Hari)
        </label>
        <input type="number" name="jatuh_tempo"
            value="{{ old('jatuh_tempo', $supplier->jatuh_tempo ?? 0) }}"
            class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium"
            placeholder="Contoh: 7 hari">
    </div>

    <!-- ===================== -->
    <!-- STATUS -->
    <!-- ===================== -->
    <div class="md:col-span-2 mt-4">
        <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">
            Status Supplier
        </label>
        <select name="status" class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium cursor-pointer appearance-none">
            <option value="aktif" {{ (old('status', $supplier->status ?? '') == 'aktif') ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="nonaktif" {{ (old('status', $supplier->status ?? '') == 'nonaktif') ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>
    </div>

</div>