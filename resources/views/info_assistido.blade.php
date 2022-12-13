@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    

<h3 class="mt-3">Informações assistido</h3>
<p>
    Nome: {{$assistido -> nome}}<br>
    nasc: {{date('d/m/Y', strtotime($assistido -> nasc))}}<br>
    @php
    $cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $assistido -> cpf);
    $tel = preg_replace("/(\d{0})(\d{2})(\d{5})(\d{4})/", "\$1(\$2)\$3-\$4", $assistido -> telefone);
    @endphp
    cpf: {{$cpf}}<br>
    email: {{$assistido -> email}}<br>
    telefone: {{$tel}}<br>
    Info: {{$assistido -> info}}
</p>

@endsection