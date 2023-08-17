<?php
namespace App\Traits;
use App\Models\File;

trait UtilitiesMaster
{

    public static function options($display, $id = 'id', $params = [], $default=null)
    {
        $q = static::select('*')->where('status','1');

        $params = array_merge([
            'valuePrefix' => '',
        ], $params);

        if (isset($params['filters'])) {
            foreach ($params['filters'] as $key => $value) {
                if (is_numeric($key) && is_callable($value)) {
                    $q = $q->where($value);
                } else {
                    if($value != '')
                        $q = $q->where($key, $value);
                }
            }
        }

        if (isset($params['orders'])) {
            foreach ($params['orders'] as $key => $value) {
                if (is_numeric($key)) {
                    $key   = $value;
                    $value = 'asc';
                }

                $q = $q->orderBy($key, $value);
            }
        }

        $r = [];

        $ret = '';
        if ($default !== false) {
            if($default === null){
                $default = '(Pilih Salah Satu)';
            }
            $ret = '<option value="">' . $default . '</option>';
        }

        if (is_string($display)) {
            $q = $q->orderBy($display, 'asc');
            $r = $q->pluck($display, $id);

            foreach ($r as $i => $v) {
                $i = $params['valuePrefix'] . $i;
                $checked = isset($params['selected']) &&
                           (is_array($params['selected']) ? in_array($i, $params['selected']) : $i == $params['selected']);
                if ($checked) {
                    $ret .= '<option value="' . $i . '" selected>' . $v . '</option>';
                } else {
                    $ret .= '<option value="' . $i . '">' . $v . '</option>';
                }
            }
        } elseif (is_callable($display)) {
            $r = $q->get();

            foreach ($r as $d) {
                $i = $params['valuePrefix'] . $d->$id;
                $checked = isset($params['selected']) &&
                           (is_array($params['selected']) ? in_array($i, $params['selected']) : $i == $params['selected']);
                if ($checked) {
                    $ret .= '<option value="' . $i . '" selected>' . $display($d) . '</option>';
                } else {
                    $ret .= '<option value="' . $i . '">' . $display($d) . '</option>';
                }
            }
        }
        return $ret;
    }

    public static function queryRaw($query)
    {
        $q = static::select('*');

        $q->from(\DB::raw("($query) as tbl"));

        return $q->get();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function crudName()
    {
        if($this->updater)
        {
          return $this->updater->name;
        }
        return isset($this->creator) ? $this->creator->name : '[System]';
    }

    public function creationDate()
    {
        if($this->updated_at)
        {
          return $this->updated_at->diffForHumans();
        }
        return $this->created_at->diffForHumans();
    }


    /* SAVE DATA */
    public static function saveData($request, $identifier = 'id')
    {
        $record = static::prepare($request, $identifier);
        if($record->rules){
            $validateData = $request->validate($record->rules);
        }
        $record->fill($request->all());
        $record->save();

        if($request->file)
        {
              $record->uploadFile($request->file);
        }
        return $record;
    }

    public static function prepare($request, $identifier = 'id')
    {
        $record = new static;

        if ($request->has($identifier) && $request->get($identifier) != null && $request->get($identifier) != 0) {
            $record = static::find($request->get($identifier));
        }
        
        return $record;
    }
    /* END SAVE DATA */

    public function uploadFile($files)
    {
        if(count($files) > 0)
        {
            foreach($files as $key => $file)
            {
                if($file != null)
                {

                  $name = str_replace(' ', '_', $file->getClientOriginalName());

                  $data['filename'] = $name;
                  $data['url'] = $file->storeAs($this->filesMorphClass(), $name, 'public');
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  $save = new File;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }
}
