@extends('layouts.app')

@section('title', 'COBA YA')

<html>
    <form action="{{ route('kertasKerjaRenaksi.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx, .xls, .csv">
        <button type="submit">Upload dan Import</button>
    </form>

    <a href="{{ route('kertasKerjaRenaksi.export') }}">
        <button>Ekspor ke Excel</button>
    </a>
</html>