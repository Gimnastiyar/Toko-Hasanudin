@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 border border-slate-100 dark:border-slate-700">
        <h1 class="text-xl font-bold text-slate-800 dark:text-white mb-6">Edit Supplier</h1>

        <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
            @csrf
            @method('PUT')

            @include('suppliers._form')

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('suppliers.index') }}"
                   class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    Batal
                </a>

                <button class="bg-green-600 dark:bg-emerald-600 hover:bg-green-700 dark:hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl shadow">
                    Update
                </button>
            </div>

        </form>
    </div>

</div>
@endsection