@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1>Staff Dashboard Test</h1>
    <p>Total Items: {{ $totalItems ?? 'Not set' }}</p>
    <p>Total Suppliers: {{ $totalSuppliers ?? 'Not set' }}</p>
    <p>Available Items: {{ $availableItems ?? 'Not set' }}</p>
    <p>Recent Items Count: {{ $recentItems ? $recentItems->count() : 'Not set' }}</p>
    <p>Recent Suppliers Count: {{ $recentSuppliers ? $recentSuppliers->count() : 'Not set' }}</p>
</div>
@endsection
