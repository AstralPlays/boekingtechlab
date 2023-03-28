<?php

namespace App\View\Components;

use Illuminate\View\Component;

class homePage extends Component
{
	public $text;
	public function __construct()
	{
		$this->text = 'This is the home page';
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.home-page', ['text' => $this->text]);
	}
}
