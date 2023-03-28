<?php

namespace App\View\Components;

use Illuminate\View\Component;

class header extends Component
{
	public $email;
	public $socialMedia;

	public function __construct()
	{
		$this->email = 'techlab@example.nl';
		$this->socialMedia = [
			['icon' => 'fa-facebook', 'link' => 'https://www.facebook.com/techlab', 'name' => 'FaceBook'],
			['icon' => 'fa-instagram', 'link' => 'https://www.facebook.com/techlab', 'name' => 'Instagram'],
			['icon' => 'fa-linkedin', 'link' => 'https://www.facebook.com/techlab', 'name' => 'Linkedin'],
			['icon' => 'fa-youtube', 'link' => 'https://www.facebook.com/techlab', 'name' => 'Youtube']
		];
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.header');
	}
}
