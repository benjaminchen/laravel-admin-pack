<?php

namespace BenjaminChen\Admin\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use BHelper;
use File;

class ModelController extends BaseController
{
    public function index($model)
    {
        $class = config("admin.classMap.{$model}");
        $datas = $class::paginate(10);
        $c = new $class;
        $columns = array_intersect(
            $c->getFillable(),
            array_keys(BHelper::arraySafeGet($c->columns, 'input', []))
        );
        return view('adminPack::model.index', [
            'model' => $model,
            'columns' => $columns,
            'datas' => $datas,
        ]);
    }

    public function create($model)
    {
        $class = config("admin.classMap.{$model}");
        $c = new $class;
        return view('adminPack::model.create', [
            'model' => $model,
            'columns' => $c->columns,
        ]);
    }

    public function store(Request $request, $model)
    {
        $class = config("admin.classMap.{$model}");
        $m = new $class;
        $v = isset($m->columns['inputValidator']) ? $m->columns['inputValidator'] : [];
        $validator = Validator::make($request->all(), $v);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $fileColumns = isset($m->columns['file']) ? $m->columns['file'] : [];
        $fileUploadFails = [];
        foreach ($fileColumns as $fieldName) {
            $newFileName = $this->fileUpload(Input::file($fieldName), public_path("upload/{$model}"));
            if ($newFileName) {
                $m->$fieldName = $newFileName;
            } else {
                $fileUploadFails[] = "{$fieldName} upload fail!!";
            }
        }

        $m->fill($request->all());

        return $m->save() ? redirect("admin/{$model}")->with('message', trans("{$model}.create_success"))->withErrors($fileUploadFails) :
                response('Server Error!', '500');
    }

    public function edit($model, $key)
    {
        $class = config("admin.classMap.{$model}");
        $m = $class::find($key);

        if (! $m) return response('Bad Request!', 400);

        return view('adminPack::model.update', [
            'model' => $model,
            'key' => $key,
            'columns' => $m->columns,
            'data' => $m,
        ]);
    }

    public function update(Request $request, $model, $key)
    {
        $class = config("admin.classMap.{$model}");
        $m = $class::find($key);

        if (! $m) return response('Bad Request!', 400);

        $v = isset($m->columns['inputValidator']) ? $m->columns['inputValidator'] : [];
        $v = BHelper::validForUpdate($v, $m->getKeyName(), $key);
        $validator = Validator::make($request->all(), $v);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $fileColumns = isset($m->columns['file']) ? $m->columns['file'] : [];
        $fileUploadFails = [];
        $path = public_path("upload/{$model}");
        foreach ($fileColumns as $fieldName => $attributes) {
            if (! ($file = Input::file($fieldName))) continue;
            $newFileName = $this->fileUpload($file, $path);
            if ($newFileName) {
                $this->deleteFile($m->$fieldName, $path);
                $m->$fieldName = $newFileName;
            } else {
                $fileUploadFails[] = "{$fieldName} upload fail!!";
            }
        }

        $m->fill($request->all());

        return $m->save() ? redirect("admin/{$model}/{$key}/edit")->with('message', trans("{$model}.updated_success"))->withErrors($fileUploadFails) :
                response('Server Error!', '500');
    }

    public function destroy($model, $key)
    {
        $class = config("admin.classMap.{$model}");
        $m = $class::find($key);

        if (! $m) return response('Bad Request!', 400);

        $result = $m->delete();
        $message = $result ? trans("{$model}.delete_success") : trans("{$model}.delete_fail");

        return response()->json([
            'result' => $result,
            'message' => $message,
        ]);
    }

    private function fileUpload($file, $path)
    {
        if (!$file) return null;
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        try {
            $newFile = $file->move($path, $fileName);
        }  catch (\Exception $e) {
            return null;
        }

        return $fileName;
    }

    private function deleteFile($file, $path)
    {
        $pathToFile = "{$path}/{$file}";
        if(File::exists($pathToFile)) {
            File::Delete($pathToFile);
        }
    }
}