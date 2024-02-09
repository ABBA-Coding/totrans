<?php


namespace Modules\Filemanager\View\Components;

use Illuminate\View\Component;
use Modules\Filemanager\Entities\Files;

class Field extends Component
{
    public $name;
    public $label;
    public $id;
    public $value;
    public $files;
    public $isMultiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$label,$id,$value=null,$files=[],$isMultiple=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->value = $value;
        $this->files = $files;
        $this->isMultiple = $isMultiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if (!empty($this->value)) {
            $this->files = Files::whereIn('id', explode(',', $this->value))->get();
            $new_arr = [];
            if (count($this->files) > 0) {
                foreach ($this->files as $file) {
                    $new_arr[] = $file->id;
                }
                $this->value = implode(',', $new_arr);
            } else {
                $this->files = '';
            }
        }

        return view('filemanager::components.field');
    }
}
