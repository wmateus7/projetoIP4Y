{{-- Ação ocorrida com sucesso --}}
@if (session('success'))
<div class="alert alert-success">{{session('success')}} 
</div>
@endif

{{-- Mensagem de erro --}}
@if (session('error'))
<div class="alert alert-danger">{{session('error')}}
</div> 
@endif

{{-- Erro do formulário --}}
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $erro)
        {{$erro}}<br/>
    @endforeach
</div>
@endif

