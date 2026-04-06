@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
        <h1 class="text-xl font-bold text-slate-800 mb-6">Edit Supplier</h1>

        <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
            @csrf
            @method('PUT')

            @include('suppliers._form')

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('suppliers.index') }}"
                   class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50">
                    Batal
                </a>

                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl shadow">
                    Update
                </button>
            </div>

        </form>
    </div>

</div>
@endsection