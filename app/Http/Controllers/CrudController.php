<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index() {
        $Datos=DB::select("select * from productos");
        return view("welcome")->with("Datos", $Datos);
    }

    public function registro(Request $request)
    {
        // Verifica los datos recibidos
        if ($request->has(['nombre', 'precio'])) {
            // Intenta guardar el producto en la tabla `productos`
            DB::table('productos')->insert([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'categoria' => $request->categoria
            ]);
    
            return redirect()->back()->with('success', 'Producto agregado correctamente');
        } else {
            return redirect()->back()->withErrors('incorrecto','Por favor, completa todos los campos requeridos.');
        }
    }

    public function modificar(Request $request, $id)
    {
        // Verifica los datos recibidos
        if ($request->has(['nombre', 'precio'])) {
            // Intenta actualizar el producto en la tabla `productos`
            DB::table('productos')
                ->where('id', $id)
                ->update([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'categoria' => $request->categoria
                ]);

            return redirect()->back()->with('success', 'Producto actualizado correctamente');
        } else {
            return redirect()->back()->withErrors('incorrecto','ERRO al actualizar, verifique los campos');
        }
    }

    public function destroy($id)
    {
        // Intenta eliminar el producto de la tabla `productos`
        $deleted = DB::table('productos')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Producto eliminado correctamente');
        } else {
            return redirect()->back()->withErrors('Error al eliminar el producto. Verifica si existe.');
        }
    }
    
    
}
