@extends('layouts.backend')

@section('css')
@endsection

@section('js')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#upload-preview').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('dashboard.order.upload.preview', "$order->id") }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#loading-preview').show();
                        $('#upload-preview').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        $('#loading-preview').hide();
                        $('#error-msg').html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<strong>' + data.responseJSON.message + '</strong>' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                        // $('#upload-preview')[0].reset();
                        // $('#upload-preview').attr('disabled', false);
                    }
                })
            });

            $('#upload-design').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('dashboard.order.upload.design', "$order->id") }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#loading-design').show();
                        $('#upload-design').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        $('#loading-design').hide();
                        $('#error-msg').html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<strong>' + data.responseJSON.message + '</strong>' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    }
                })
            });
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
                    <span class="breadcrumb-item active">{{ $order->number }}</span>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-row">
            <div class="me-2">
                <a href="{{ route('dashboard.index') }}" class="btn btn-danger">
                    <i class="fa fa-fw fa-chevron-left text-white me-1"></i>
                    <span class="d-none d-sm-inline">Voltar</span>
                </a>
            </div>
            <div class="me-2">
                <button type="button" class="btn btn-secondary">
                    <i class="fa fa-fw fa-pen text-white me-1"></i>
                    <span class="d-none d-sm-inline">Editar</span>
                </button>
            </div>
            <div class="">
                <div class="dropdown">
                    @php
                        $color = 'btn-primary';
                        if ($order->status == 'aprovado') {
                            $color = 'btn-success';
                        } elseif ($order->status == 'aguard. aprov') {
                            $color = 'btn-warning';
                        } elseif ($order->status == 'aguard. arte') {
                            $color = 'btn-info';
                        }
                    @endphp
                    <button type="button" class="btn {{ $color }} dropdown-toggle" id="dropdown-default-primary"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if ($order->status == 'aprovado')
                            Aprovado
                        @elseif ($order->status == 'aguard. aprov')
                            Aguardando Aprov.
                        @elseif ($order->status == 'aguard. arte')
                            Aguardando Arte
                        @endif
                    </button>
                    <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-primary">
                        <a class="dropdown-item" href="javascript:void(0)">Aprovado</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)">Aguardando Aprov.</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)">Aguardando Arte</a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="content-heading">Informações do Cliente</h2>
        <div class="row items-push">
            <div class="col-md-12">
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-content fs-md">
                        <div class="fw-bold mb-1">{{ $order->customer->name }}</div>
                        <address>
                            <i class="fa fa-phone me-1"></i>
                            {{ $order->customer->phone ? $order->customer->phone : 'Não cadastrado' }}<br>
                            <i class="far fa-envelope me-1"></i> <a
                                href="javascript:void(0)">{{ $order->customer->email ? $order->customer->email : 'Não cadastrado' }}</a>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="content-heading">Arquivos</h2>
        <div class="row items-push">
            <div class="col-md-12">
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-content fs-md">
                        <div id="error-msg"></div>
                        <div class="d-flex flex-row mb-4">
                            <div>
                                <div class="fw-bold">
                                    Pré-visualização
                                </div>
                                <div>
                                    @if ($order->preview)
                                        <img src="{{ asset('preview/' . $order->preview) }}" alt="Pré-visualização"
                                            class="img-fluid w-50" />
                                    @else
                                        <img src="{{ asset('media/photos/noimage.jpg') }}" alt="Pré-visualização"
                                            class="img-fluid" />
                                    @endif
                                </div>
                                <div id="loading-preview" class="mx-4 mt-4" style="display: none">
                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <style>
                                            .spinner_DupU {
                                                animation: spinner_sM3D 1.2s infinite
                                            }

                                            .spinner_GWtZ {
                                                animation-delay: .1s
                                            }

                                            .spinner_dwN6 {
                                                animation-delay: .2s
                                            }

                                            .spinner_46QP {
                                                animation-delay: .3s
                                            }

                                            .spinner_PD82 {
                                                animation-delay: .4s
                                            }

                                            .spinner_eUgh {
                                                animation-delay: .5s
                                            }

                                            .spinner_eUaP {
                                                animation-delay: .6s
                                            }

                                            .spinner_j38H {
                                                animation-delay: .7s
                                            }

                                            .spinner_tVmX {
                                                animation-delay: .8s
                                            }

                                            .spinner_DQhX {
                                                animation-delay: .9s
                                            }

                                            .spinner_GIL4 {
                                                animation-delay: 1s
                                            }

                                            .spinner_n0Yb {
                                                animation-delay: 1.1s
                                            }

                                            @keyframes spinner_sM3D {

                                                0%,
                                                50% {
                                                    animation-timing-function: cubic-bezier(0, 1, 0, 1);
                                                    r: 0
                                                }

                                                10% {
                                                    animation-timing-function: cubic-bezier(.53, 0, .61, .73);
                                                    r: 2px
                                                }
                                            }
                                        </style>
                                        <circle class="spinner_DupU" cx="12" cy="3" r="0" />
                                        <circle class="spinner_DupU spinner_GWtZ" cx="16.50" cy="4.21" r="0" />
                                        <circle class="spinner_DupU spinner_n0Yb" cx="7.50" cy="4.21" r="0" />
                                        <circle class="spinner_DupU spinner_dwN6" cx="19.79" cy="7.50" r="0" />
                                        <circle class="spinner_DupU spinner_GIL4" cx="4.21" cy="7.50" r="0" />
                                        <circle class="spinner_DupU spinner_46QP" cx="21.00" cy="12.00" r="0" />
                                        <circle class="spinner_DupU spinner_DQhX" cx="3.00" cy="12.00" r="0" />
                                        <circle class="spinner_DupU spinner_PD82" cx="19.79" cy="16.50" r="0" />
                                        <circle class="spinner_DupU spinner_tVmX" cx="4.21" cy="16.50" r="0" />
                                        <circle class="spinner_DupU spinner_eUgh" cx="16.50" cy="19.79" r="0" />
                                        <circle class="spinner_DupU spinner_j38H" cx="7.50" cy="19.79" r="0" />
                                        <circle class="spinner_DupU spinner_eUaP" cx="12" cy="21" r="0" />
                                    </svg>
                                </div>
                                @if (!$order->preview)
                                    <div>
                                        <form action="{{ route('dashboard.order.upload.preview', $order->id) }}"
                                            id="upload-preview" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-4">
                                                <div class="col-md-12 col-xl-12 fw-bold">
                                                    Nenhum arquivo foi enviado
                                                </div>
                                            </div>
                                            <div class="row d-block">
                                                <div class="col-lg-12 col-xl-12 overflow-hidden">
                                                    <div class="mb-4">
                                                        <input class="form-control" type="file" name="preview"
                                                            id="example-file-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xl-12 overflow-hidden">
                                                    <button type="submit" class="btn btn-primary">Importar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <div class="">
                                <div class="fw-bold">
                                    Arquivo de Design PDF
                                </div>
                                <div>
                                    @if ($order->design_file)
                                        <div class="mt-5">
                                            <a href="{{ asset('design/' . $order->design_file) }}" target="_blank"
                                                class="btn btn-primary">
                                                <i class="fa fa-fw fa-download text-white me-1"></i>
                                                <span class="d-none d-sm-inline">Baixar Arquivo</span>
                                            </a>
                                        </div>
                                    @else
                                        <img src="{{ asset('media/photos/noimage.jpg') }}" alt="Pré-visualização"
                                            class="img-fluid" />
                                    @endif
                                </div>
                                <div id="loading-design" class="mx-4 mt-4" style="display: none">
                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <style>
                                            .spinner_DupU {
                                                animation: spinner_sM3D 1.2s infinite
                                            }

                                            .spinner_GWtZ {
                                                animation-delay: .1s
                                            }

                                            .spinner_dwN6 {
                                                animation-delay: .2s
                                            }

                                            .spinner_46QP {
                                                animation-delay: .3s
                                            }

                                            .spinner_PD82 {
                                                animation-delay: .4s
                                            }

                                            .spinner_eUgh {
                                                animation-delay: .5s
                                            }

                                            .spinner_eUaP {
                                                animation-delay: .6s
                                            }

                                            .spinner_j38H {
                                                animation-delay: .7s
                                            }

                                            .spinner_tVmX {
                                                animation-delay: .8s
                                            }

                                            .spinner_DQhX {
                                                animation-delay: .9s
                                            }

                                            .spinner_GIL4 {
                                                animation-delay: 1s
                                            }

                                            .spinner_n0Yb {
                                                animation-delay: 1.1s
                                            }

                                            @keyframes spinner_sM3D {

                                                0%,
                                                50% {
                                                    animation-timing-function: cubic-bezier(0, 1, 0, 1);
                                                    r: 0
                                                }

                                                10% {
                                                    animation-timing-function: cubic-bezier(.53, 0, .61, .73);
                                                    r: 2px
                                                }
                                            }
                                        </style>
                                        <circle class="spinner_DupU" cx="12" cy="3" r="0" />
                                        <circle class="spinner_DupU spinner_GWtZ" cx="16.50" cy="4.21" r="0" />
                                        <circle class="spinner_DupU spinner_n0Yb" cx="7.50" cy="4.21" r="0" />
                                        <circle class="spinner_DupU spinner_dwN6" cx="19.79" cy="7.50" r="0" />
                                        <circle class="spinner_DupU spinner_GIL4" cx="4.21" cy="7.50" r="0" />
                                        <circle class="spinner_DupU spinner_46QP" cx="21.00" cy="12.00" r="0" />
                                        <circle class="spinner_DupU spinner_DQhX" cx="3.00" cy="12.00" r="0" />
                                        <circle class="spinner_DupU spinner_PD82" cx="19.79" cy="16.50" r="0" />
                                        <circle class="spinner_DupU spinner_tVmX" cx="4.21" cy="16.50" r="0" />
                                        <circle class="spinner_DupU spinner_eUgh" cx="16.50" cy="19.79" r="0" />
                                        <circle class="spinner_DupU spinner_j38H" cx="7.50" cy="19.79" r="0" />
                                        <circle class="spinner_DupU spinner_eUaP" cx="12" cy="21" r="0" />
                                    </svg>
                                </div>
                                @if (!$order->design_file)
                                    <div>
                                        <form action="{{ route('dashboard.order.upload.design', $order->id) }}"
                                            id="upload-design" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-4">
                                                <div class="col-md-12 col-xl-12 fw-bold">
                                                    Nenhum arquivo foi enviado
                                                </div>
                                            </div>
                                            <div class="row d-block">
                                                <div class="col-lg-12 col-xl-12 overflow-hidden">
                                                    <div class="mb-4">
                                                        <input class="form-control" type="file" name="design"
                                                            id="example-file-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xl-12 overflow-hidden">
                                                    <button type="submit" class="btn btn-primary">Importar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="content-heading">Produtos</h2>
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 100px;">ID</th>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $product)
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ strtoupper($product->name) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $product->qtd }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
