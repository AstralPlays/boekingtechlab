<?php

namespace App\Modules\Material\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Material\Clients\Contracts\MaterialClientInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MaterialController extends Controller
{
	public function __construct(
		private MaterialClientInterface $MaterialClient
	) {
	}

	public function index()
	{
		return $this->MaterialClient->all();
	}

	public function getMaterials(): array
	{
		$materials = $this->MaterialClient->getMaterials();
		$list = [];
		foreach ($materials as $material) {
			$list[] = [
				'id' => $material->id,
				'name' => $material->name,
				'quantity' => $material->quantity,
				'image' => $material->image,
				'rooms_id' => $material->rooms_id,
			];
		}
		return $list;
	}

	public function addMaterial(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'materialName' => 'required|string',
				'quantity' => 'required|integer',
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			])->validate();
		} catch (ValidationException $exception) {
			return Response(json_encode(['error' => $exception->errors()]), 415);
		}

		$materialName = $request['materialName'];
		$quantity = $request['quantity'];
		$imageName = time() . '.' . request()->image->getClientOriginalExtension();
		request()->image->move(public_path('images/materials'), $imageName);

		$material = [
			'name' => $materialName,
			'quantity' => $quantity,
			'image' => $imageName
		];

		if ($this->MaterialClient->addMaterial($material)) {
			return Response(json_encode(['success' => $material]), 200);
		}

		return Response(json_encode('error'), 400);
	}

	public function removeMaterial(Request $request)
	{
		$id = $request['id'];
		if ($this->MaterialClient->removeMaterial($id)) {
			return Response(json_encode('success'), 200);
		}
		return Response(json_encode('Material Not Found'), 404);
	}
}
