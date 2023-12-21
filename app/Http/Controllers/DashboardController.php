<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index() : \Illuminate\View\View
    {
        $approved = Order::query()->where('status', 'aprovado')->count();
        $waitingApproval = Order::query()->where('status', 'aguard. aprov')->count();
        $waitingArt = Order::query()->where('status', 'aguard. arte')->count();

        return view('dashboard', compact('approved', 'waitingApproval', 'waitingArt'));
    }

    public function list()
    {
        $model = Order::query()->with(['customer', 'orderProducts']);

        return DataTables::of($model)
            ->editColumn('date', function ($model) {
                return $model->date->format('d/m/Y');
            })
            ->editColumn('customer.name', function ($model) {
                return strtoupper($model->customer->name);
            })
            ->editColumn('status', function ($model) {
                if ($model->status === 'aprovado') {
                    return '<span class="badge bg-success">Aprovado</span>';
                } else if ($model->status === 'aguard. aprov') {
                    return '<span class="badge bg-warning">Aguardando Aprov.</span>';
                } else if ($model->status === 'aguard. arte') {
                    return '<span class="badge bg-info">Aguardando Arte</span>';
                } else {
                    return '<span class="badge bg-black-50">Não definido</span>';
                }
            })
            ->editColumn('employee', function ($model) {
                return $model->employee ? strtoupper($model->employee) : 'Não definido';
            })
            ->addColumn('action', function ($model) {
                return '<a href="' . route('dashboard.order.show', $model->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye" /></a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
