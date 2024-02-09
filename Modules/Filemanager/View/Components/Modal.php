<?php


namespace Modules\Filemanager\View\Components;

use Illuminate\View\Component;


class Modal extends Component
{
    public $files;
    public $folders;
    public $activeFolder;
    public $show = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($files=[],$folders=[])
    {
        $this->files = $files;
        $this->folders = $folders;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('filemanager::components.modal');
    }
}
