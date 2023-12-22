@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        function addRow() {
            var newRow = `<tr>
                    <td><input type="text" class="form-control" name="product[]" /></td>
                    <td><input type="text" class="form-control" name="quantity[]" /></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remover</button></td>
                  </tr>`;
            jQuery('#productTable tbody').append(newRow);
        }

        function removeRow(button) {
            jQuery(button).closest('tr').remove();
        }

        jQuery(function() {

            // Select2
            jQuery('.customer-select').select2({
                placeholder: 'Selecione um cliente..',
                allowClear: true
            });

            jQuery('#employee').select2({
                placeholder: 'Selecione o Arte Finalista..',
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
                <form action="#" method="POST" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-3">
                            <p class="fw-bold">
                                Informações Gerais
                            </p>
                        </div>
                        <div class="col-lg-9">
                            <!-- Form Grid -->
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
                                <div class="col-3">
                                    <input type="text" placeholder="Data da Emissão" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" placeholder="N. do Pedido" class="form-control">
                                </div>
                                <div class="col-4">
                                    <select name="employee" id="employee" class="form-control" placeholder="Vendedor">
                                        <option value=""></option>
                                        <option value="bruno">Bruno</option>
                                        <option value="ricardo">Ricardo</option>
                                        <option value="rubens">Rubens</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="Data da Entrega" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="fw-bold">
                                Produtos
                            </p>
                        </div>
                        <div class="col-lg-9">
                            <table class="table table-bordered" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th style="width: 150px">Quantidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="product[]" /></td>
                                        <td><input type="text" class="form-control" name="qtd[]" /></td>
                                        <td><button type="button" class="btn btn-danger"
                                                onclick="removeRow(this)">Remover</button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end">
                                            <button type="button" class="btn btn-success" onclick="addRow()">Adicionar
                                                Produto</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex row mb-2">
                        <button type="submit" class="btn btn-success col-md-2">Salvar</button>
                        <a class="btn btn-warning col-md-2 ms-1" href="{{ route('dashboard.index') }}">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- END Page Content -->
@endsection
