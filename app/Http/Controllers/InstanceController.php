<?php

namespace App\Http\Controllers;

use App\Models\Instance;
use Illuminate\Http\Request;
use App\Models\Livro;

use App\Http\Requests\InstanceRequest;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');

        $instances = Instance::where('status','!=','Ativo')->get();

        return view('instances.index',[
            'instances' => $instances
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('admin');
        $livro = Livro::find($request->livro_id);

        return view('instances.create',[
            'instance' => new Instance,
            'livro' => $livro
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstanceRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $instance = Instance::create($validated);

        return redirect("/livros/{$instance->livro->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance)
    {
        $this->authorize('admin');
        return view('instances.show',[
            'instance' => $instance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instance, Request $request)
    {
        $this->authorize('admin');
        $livro = Livro::find($request->livro_id);
        return view('instances.edit',[
            'instance' => $instance,
            'livro' => $livro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(InstanceRequest $request, Instance $instance)
    {
        $this->authorize('admin');

        $validated = $request->validated();
        $instance->update($validated);

        return redirect("/livros/{$instance->livro->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        $this->authorize('admin');
        $livro_id = $instance->livro->id;
        $instance->delete();
        return redirect("/livros/{$livro_id}");
    }
}
