<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $customers = Customer::query()->orderBy('name')->get();

        return view('pages.order.create', compact('customers'));
    }

    public function show($id)
    {
        $order = Order::query()->with(['customer', 'orderProducts'])->findOrFail($id);

        return view('pages.order.show', compact('order'));
    }

    public function uploadPreview(Request $request, $id)
    {
        $request->validate([
            'preview' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'preview.required' => 'O campo arquivo é obrigatório.',
            'preview.image' => 'O campo arquivo deve ser uma imagem.',
            'preview.mimes' => 'O campo arquivo deve ser uma imagem válida.',
            'preview.max' => 'O campo arquivo deve ter no máximo 2MB.',
        ]);

        $order = Order::query()->findOrFail($id);

        $imageName = time() . '.' . $request->file('preview')->extension();

        $request->file('preview')->storeAs('', $imageName, ['disk' => 'preview']);

        $order->update([
            'preview' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Preview enviado com sucesso!',
        ]);
    }

    public function uploadDesign(Request $request, $id)
    {
        $request->validate([
            'design' => 'required|mimes:pdf|max:4096',
        ], [
            'design.required' => 'O campo arquivo é obrigatório.',
            'design.mimes' => 'O campo arquivo deve ser um PDF.',
            'design.max' => 'O campo arquivo deve ter no máximo 2MB.',
        ]);

        $order = Order::query()->findOrFail($id);

        $imageName = time() . '.' . $request->file('design')->extension();

        $request->file('design')->storeAs('', $imageName, ['disk' => 'design']);

        $order->update([
            'design_file' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Design enviado com sucesso!',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aprovado,aguard. aprov,aguard. arte',
        ], [
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser um dos seguintes valores: Aprovado, Aguard. Aprov, Aguard. Arte.',
        ]);

        $order = Order::query()->findOrFail($id);

        $order->update([
            'status' => $request->get('status'),
        ]);

        session()->flash('success', 'Status atualizado com sucesso!');
        return response()->json([
            'success' => true,
            'message' => 'Status atualizado com sucesso!',
        ]);
    }

    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'employee' => 'required|string|max:255',
        ], [
            'employee.string' => 'O campo funcionário deve ser uma string.',
            'employee.max' => 'O campo funcionário deve ter no máximo 255 caracteres.',
        ]);

        $order = Order::query()->findOrFail($id);

        $order->update([
            'employee' => $request->get('employee'),
        ]);

        session()->flash('success', 'Arte Finalista atualizado com sucesso!');
        return response()->json([
            'success' => true,
            'message' => 'Arte Finalista atualizado com sucesso!',
        ]);
    }
}
