@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        jQuery(function() {
            // Select2
            jQuery('.customer-select').select2({
                placeholder: 'Selecione um cliente..',
                allowClear: true
            });

            jQuery('#new-client').click(function() {});
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="bg-body-light border-bottom mb-4">
            <div class="content py-1 text-center">
                <nav class="breadcrumb bg-body-light py-2 mb-0">
                    <a class="breadcrumb-item" href="{{ route('dashboard.index') }}">Painel</a>
                    <a class="breadcrumb-item" href="#">Pedidos</a>
                    <span class="breadcrumb-item active">Criar</span>
                </nav>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cadastro de Pedido em Produção</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fw-bold">
                            Informações Gerais
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <!-- Form Grid -->
                        <form action="be_forms_layouts.html" method="POST" onsubmit="return false;">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <select class="customer-select form-select" id="customer_id" name="customer_id"
                                        style="width: 80%;" data-placeholder="Selecione um cliente..">
                                        <option></option>
                                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ strtoupper($customer->name) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="new-client" class="btn btn-md btn-alt-primary">Novo
                                        Cliente</button>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="col-4">
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" placeholder="col-8">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-5">
                                    <input type="text" class="form-control" placeholder="col-5">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="col-4">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="col-3">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-8">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-8">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-4">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-6">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-alt" placeholder="col-3">
                                </div>
                            </div>
                        </form>
                        <!-- END Form Grid -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <p class="fw-bold">
                            Produtos
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <!-- Form Grid with Labels -->
                        <form action="be_forms_layouts.html" method="POST" onsubmit="return false;">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-8">
                                    <label class="form-label">.col-8</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-5">
                                    <label class="form-label">.col-5</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-8">
                                    <label class="form-label">.col-8</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">.col-4</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">.col-6</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">.col-3</label>
                                    <input type="text" class="form-control form-control-alt">
                                </div>
                            </div>
                        </form>
                        <!-- END Form Grid with Labels -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
