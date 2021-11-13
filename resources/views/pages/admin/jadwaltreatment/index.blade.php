@extends('layouts.default')

@section('title')
    Mastering Jadwal Treatment
@endsection

@push('before-script')

    @if (session('status'))
        <x-sweetalertsession tipe="{{ session('tipe') }}" status="{{ session('status') }}" />
    @endif
@endpush


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
                <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @if ($datas->count() > 0)
                        <x-jsdatatable />
                    @endif

                    <x-jsmultidel link="{{ route('produk.multidel') }}" />

                    <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                        <thead>
                            <tr style="background-color: #F1F1F1">
                                <th class="text-center py-2 babeng-min-row"> No</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr>
                                    <td class="text-center">

                                        {{ $loop->index + 1 }}</td>
                                        {{-- {{dd($datas, $data)}} --}}
                                    <td>
                                        {{ $data->hari }}
                                    </td>
                                    <td>
                                        @forelse ($data->jam as $jam)
                                            <button class="btn btn-light"> {{ $jam }}</button>
                                        @empty
                                            Data tidak ditemukan
                                        @endforelse

                                        <button class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> </button>
                                    </td>

                                    <td class="babeng-min-row">
                                        @forelse ($data->ruangan as $ruangan)
                                            <button class="btn btn-light"> {{ $ruangan }}</button>
                                        @empty

                                        @endforelse
                                        <button class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> </button>
                                    </td>
                                    {{-- <td class="babeng-min-row">
                                    <button class="btn btn-sm btn-info"> Edit </button>
                                </td> --}}


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </section>
@endsection


@section('containermodal')

@endsection
